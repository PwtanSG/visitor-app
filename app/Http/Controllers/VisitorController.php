<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\User;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VisitorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VisitorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $search_keyword = $request->query('search');
        $datein_from = $request->query('checkin_from');
        $datein_to = $request->query('checkin_to');

        $visitor_records = Visitor::where('datetime_in', '<=', date('Y-m-d') . ' 23:59:59');

        if (!empty($search_keyword)) {
            $visitor_records->where('name', 'LIKE', '%' . $search_keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $search_keyword . '%')
                ->orWhere('purpose', 'LIKE', '%' . $search_keyword . '%')
                ->orWhere('contact', 'LIKE', '%' . $search_keyword . '%')
                ->orWhere('transport', 'LIKE', '%' . $search_keyword . '%');
        }

        if (!empty($datein_from)) {
            $visitor_records->where('datetime_in', '>=', $datein_from . ' 00:00:00');
        }
        if (!empty($datein_to)) {
            $visitor_records->where('datetime_in', '<=', $datein_to . ' 23:59:59');
        }

        $visitor_records = $visitor_records->paginate(10);
        // dd($visitor_records);

        return view('visitor.index', ['records' => $visitor_records]);
    }

    public function show($id)
    {
        // $userid = auth()->user()->id;
        $record = Visitor::findOrFail($id);
        return view('visitor.show', ['record' => $record]);
    }


    public function create()
    {
        return view('visitor.create');
    }

    public function store(Request $request)
    {
        $records = Visitor::all();
        if ($records->count() > 25) {
            return redirect('/visitor/register')->with('error', 'You have exceeded the limit.');
        }
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|min:3',
            'contact' => 'required|min:8|max:15',
            'email' => 'required|email',
            'purpose' => 'required|max:255',
            'transport' => 'required|max:10',
            'document' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg,pdf,docx,doc|max:4096',
            // 'document' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'vehicle_no' => 'required_if:transport,vehicle'
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretkey = config('services.recaptcha.secret');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$userIP";
                $response = \file_get_contents($url);
                $response = json_decode($response);
                // dd($response);
                if(!$response->success) {
                    Session::flash('g-recaptcha-response', 'please check reCaptcha');
                    Session::flash('alert-class', 'alert-danger');
                    $fail($attribute.'Google reCatpcha failed');
                }
            },
        ], [
            '*.required' => 'This field is required',
            'name.min' => 'min 3 characters',
            'contact.min' => 'Min 8 digits',
            'contact.max' => 'Exceeded max 15 digits'
            // 'contact.required' => 'This field is required',
        ]);

        // $filename = '';
        $filePathToDb = '';
        // dd($request->document);
        if ($request->hasFile('document')) {
            // $filename = $request->getSchemeAndHttpHost() . '/docs/' . time() . '.' . $request->document->extension();
            // dd($filename);
            // $request->document->move(public_path('/docs/'), $filename);
            // $filename = time() . '.' . $request->document->extension();
            $fname = time() . '-' . $request->document->getClientOriginalName();
            $fname = preg_replace("/\s+/", "", $fname);
            $filePath = 'images/' . $fname;
            // dd($filePath);
            $path = Storage::disk('s3')->put($filePath, file_get_contents($request->document));
            $filePathToDb = 'https://pwt-bucket-s3.s3.amazonaws.com/' . $filePath;
        }

        // dd($request);
        $current = Carbon::now();
        Visitor::create([
            'name' => htmlentities($request->name),
            'email' => $request->email,
            'contact' => htmlentities($request->contact),
            'purpose' => htmlentities($request->purpose),
            'datetime_in' => $current->toDateTimeString(),
            'transport' => $request->transport,
            'filepath' => $filePathToDb
            // 'filepath' => $filename,
            // 'datetime_in' => date('Y-m-d H:i:s')
        ]);

        return redirect('/visitor/register')->with('success', 'You have registered successfully.');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required|numeric|',
        ], [
            '*.required' => 'numberic input is required',
            '*.numeric' => 'numberic input is required',
        ]);
        $current = Carbon::now();
        $record = Visitor::findOrFail($id);
        // $record->bgl = $request->input('bgl');
        $record->datetime_out = $current->toDateTimeString();
        $record->save();
        return redirect('/admin/visitor/' . $request->id)->with('success', 'You have check out successfully.');
    }

    public function viewPDF()
    {

        $visitors = Visitor::all();
        $pdf = PDF::loadView('pdf.visitorlist', array('visitors' => $visitors))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function downloadPDF()
    {

        $visitors = Visitor::all();
        $pdf = PDF::loadView('exports.pdfvisitors', array('visitors' => $visitors))->setPaper('a4', 'landscape');
        return $pdf->download('export_visitors_'.date("Ymd_His").'.pdf');
    }

    public function downloadExcel()
    {
        // $visitors = Visitor::all();
        return Excel::download(new VisitorExport, 'export_visitors_'.date("Ymd_His").'.xlsx');
    }
}
