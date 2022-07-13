<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\PresenceAbsence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PresenceAbsenceController extends Controller
{

    public function index()
    {
        Carbon::setLocale('ar');
        $day = Carbon::now()->translatedFormat('l');
        $date = Carbon::now()->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        $presence_absences = PresenceAbsence::where('date', $date)->get();
        return view('presence_absence.index')->with('officers', Officer::orderBy('status', 'DESC')->where('status', 1)->get())
            ->with('presence_absences', $presence_absences)
            ->with('date', $date)
            ->with('today', $today)
            ->with('day', $day);

        // return view('presence_absence.index')->with('presence_absences', $presence_absences)
        //     ->with('officers', Officer::all());
    }

    // public function presence_absencesTrashed(Request $request)
    // {
    //     $presence_absences = PresenceAbsence::orderBy('date', 'DESC')->where('company_id', $id)->get();
    //     return view('presence_absence.trashed')->with('presence_absences', $presence_absences)
    //         ->with('company', Company::find($id));
    // }

    public function store(Request $request)
    {
        $leave = strtotime($request->leave);
        $audience = strtotime($request->audience);
        $break = strtotime($request->break);
        $working_hours = gmdate('H:i', $leave - $audience - $break);
        $incapacity_hours = gmdate('H:i', strtotime("08:00") - ($leave - $audience - $break));

        if ($incapacity_hours >= '08:00') {
            $working_hours = gmdate('H:i', strtotime("08:00"));
            $incapacity_hours = gmdate('H:i', strtotime("00:00"));
        }

        $presence_absence = PresenceAbsence::create([
            'officer_id' => $request->officer_id,
            'day' => $request->day,
            'date' => $request->date,
            'audience' => $request->audience,
            'leave' => $request->leave,
            'break' => $request->break,
            'working_hours' => $working_hours,
            'incapacity_hours' =>  $incapacity_hours,
            'clarifications' => $request->clarifications,
        ]);
        $today = Carbon::now()->format('Y-m-d');
        $presence_absences = PresenceAbsence::where('date', $presence_absence->date)->get();
        return view('presence_absence.index')->with('officers', Officer::orderBy('status', 'DESC')->get())
            ->with('presence_absences', $presence_absences)
            ->with('date', $presence_absence->date)
            ->with('today', $today)
            ->with('day', $presence_absence->day);
    }


    public function edit(Request $request)
    {
        Carbon::setLocale('ar');
        $day = Carbon::parse($request->date)->translatedFormat('l');
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        $presence_absences = PresenceAbsence::where('date', $date)->get();
        return view('presence_absence.index')->with('officers', Officer::orderBy('status', 'DESC')->where('status', 1)->get())
            ->with('presence_absences', $presence_absences)
            ->with('date', $date)
            ->with('today', $today)
            ->with('day', $day);
    }

    public function update(Request $request)
    {
        $leave = strtotime($request->leave);
        $audience = strtotime($request->audience);
        $break = strtotime($request->break);
        $working_hours = gmdate('H:i', $leave - $audience - $break);
        $incapacity_hours = gmdate('H:i', strtotime("08:00") - ($leave - $audience - $break));

        if ($incapacity_hours >= '08:00') {
            $working_hours = gmdate('H:i', strtotime("08:00"));
            $incapacity_hours = gmdate('H:i', strtotime("00:00"));
        }
        $presence_absence = PresenceAbsence::find($request->id);


        $presence_absence->officer_id = $request->officer_id;
        $presence_absence->day = $request->day;
        $presence_absence->date = $request->date;
        $presence_absence->audience = $request->audience;
        $presence_absence->leave = $request->leave;
        $presence_absence->break = $request->break;
        $presence_absence->working_hours = $working_hours;
        $presence_absence->incapacity_hours = $incapacity_hours;
        $presence_absence->clarifications = $request->clarifications;
        $presence_absence->save();

        if (URL::previous() === route('presence.absence.edit') || URL::previous() === route('presence.absence.update')) {
            $today = Carbon::now()->format('Y-m-d');
            $presence_absences = PresenceAbsence::where('date', $presence_absence->date)->get();
            return view('presence_absence.index')->with('officers', Officer::orderBy('status', 'DESC')->get())
                ->with('presence_absences', $presence_absences)
                ->with('date', $presence_absence->date)
                ->with('today', $today)
                ->with('day', $presence_absence->day);
        }
        return redirect()->back();
    }

    public function officer($id)
    {
        $officer = Officer::where('id', $id)->with(['presenceAbsence' => function ($query) {
            // $current_month = Carbon::now()->subMonth(1)->format('m');
            $current_month = Carbon::now()->format('m');
            $query->orderBy('date', 'DESC')
                ->whereMonth('date', $current_month)->get();
        }])->first();

        $today = Carbon::now()->format('Y-m-d');
        $previous_month = Carbon::now()->subMonth(1)->format('Y-m-d');

        return view('presence_absence.officer')->with('officer', $officer)
            ->with('today', $today)
            ->with('previous_month', $previous_month);
    }

    public function filterOfficer(Request $request, $id)
    {
        $officer = Officer::where('id', $id)->with(['presenceAbsence' => function ($query) use ($request) {
            // $current_month = Carbon::now()->subMonth(1)->format('m');
            $query->whereBetween('date', [$request->from, $request->to])
                ->orderBy('date', 'DESC')->get();
        }])->first();
        $today = Carbon::now()->format('Y-m-d');
        $previous_month = Carbon::now()->subMonth(1)->format('Y-m-d');

        return view('presence_absence.officer')->with('officer', $officer)
            ->with('today', $today)
            ->with('previous_month', $previous_month);
    }
}
