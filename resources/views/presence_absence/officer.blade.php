@extends('dashboard.include')

@php
$count = 0;
$working_minutes=0;
$incapacity_minutes=0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $item)
                <li>
                    {{$item}}
                </li>
                @endforeach
            </ul>
            @endif

            <div>
                كشف حضور : {{$officer->name}}
                <br />
            </div>
            <br />

            <form action="{{route('presence.absence.filterOfficer',['id'=>$officer->id])}}" method="POST">
                @csrf
                <label for="">من</label>
                <input name="from" type="date" max="{{ $today }}" value="{{ $previous_month }}">
                <label for="">الى</label>
                <input name="to" type="date" max="{{ $today }}" value="{{ $today }}">
                <button style="border: none;">عرض</button>

            </form>

            <br />
            <br />





        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اليوم</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">وقت الحضور</th>
                        <th scope="col">وقت الانصراف</th>
                        <th scope="col">مدة الاستراحة</th>
                        <th scope="col">ساعات العمل</th>
                        <th scope="col">ساعات العجز</th>
                        <th scope="col">الايضاحات</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($officer->presenceAbsence as $item)

                    <?php
                    $working_hours = explode(':', $item->working_hours);
                    $working_minutes += $working_hours[0] * 60 + $working_hours[1];
                    $incapacity_hours = explode(':', $item->incapacity_hours);
                    $incapacity_minutes += $incapacity_hours[0] * 60 + $incapacity_hours[1];
                    ?>
                    <form action="{{route('presence.absence.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="officer_id" value="{{$officer->id}}">
                        <input type="hidden" name="day" value="{{$item->day}}">
                        <input type="hidden" name="date" value="{{$item->date}}">
                        <tr>
                            <th scope="row">{{++$count}}</th>
                            <td>{{$item->day}}</td>
                            <td>{{$item->date}}</td>
                            <td>
                                <input type="time" name="audience" value="{{$item->audience}}">
                            </td>
                            <td>
                                <input type="time" name="leave" value="{{$item->leave}}">
                            </td>
                            <td>
                                <input type="text" name="break" placeholder="00:00" value="{{$item->break}}">
                            </td>
                            <td>{{$item->working_hours}}</td>
                            <td>{{$item->incapacity_hours}}</td>
                            <td>
                                <input type="text" name="clarifications" value="{{$item->clarifications}}">
                            </td>

                            <td>
                                <button type="submit">حفظ</button>
                            </td>
                        </tr>
                    </form>
                    @endforeach


                </tbody>
            </table>

            <br />
            <br />
            <div>
                ساعات العمل : {{floor($working_minutes/60) .':'.$working_minutes%60}}
                <br />
                ساعات العجز : {{floor($incapacity_minutes/60) .':'.$incapacity_minutes%60}}
                <br />
            </div>

        </div>
    </div>
</div>

@endsection