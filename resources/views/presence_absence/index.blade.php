@extends('dashboard.include')

@php
$count = 0;
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
        كشف الحضور ليوم : {{$day}}
        <br />
        بتاريخ : {{$date}}
      </div>
      <br />

      <form action="{{route('presence.absence.edit')}}" method="POST">
        @csrf
        <input name="date" type="date" max="{{ $today }}" value="{{ $date }}">
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
            <th scope="col">اسم الموظف</th>
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

          @if ($day != 'الجمعة' && $day != 'السبت')


          @foreach ($officers as $officer)
          <?php $i = 0; ?>
          @foreach ($presence_absences as $presence_absence )

          @if ($officer->id == $presence_absence->officer_id)
          <?php $i = 1; ?>
          <form action="{{route('presence.absence.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$presence_absence->id}}">
            <input type="hidden" name="officer_id" value="{{$officer->id}}">
            <tr>
              <th scope="row">{{++$count}}</th>
              <th scope="row">
                <a href="{{route('presence.absence.officer',['id'=> $officer->id])}}" target="_blank">{{$officer->name}}</a>
              </th>
              <input type="hidden" name="day" value="{{$day}}">
              <input type="hidden" name="date" value="{{$date}}">
              <td>
                <input type="time" name="audience" value="{{$presence_absence->audience}}">
              </td>
              <td>
                <input type="time" name="leave" value="{{$presence_absence->leave}}">
              </td>
              <td>
                <input type="text" name="break" placeholder="00:00" value="{{$presence_absence->break}}">
              </td>
              <td>{{$presence_absence->working_hours}}</td>
              <td>{{$presence_absence->incapacity_hours}}</td>
              <td>
                <input type="text" name="clarifications" value="{{$presence_absence->clarifications}}">
              </td>

              <td>
                <button type="submit">حفظ</button>
              </td>
            </tr>
          </form>
          @endif

          @endforeach
          @if ($i == 0)
          <form action="{{route('presence.absence.store')}}" method="POST">
            @csrf
            <input type="hidden" name="officer_id" value="{{$officer->id}}">
            <tr>
              <th scope="row">{{++$count}}</th>
              <th scope="row">
                <a href="{{route('presence.absence.officer',['id'=> $officer->id])}}" target="_blank">{{$officer->name}}</a>
              </th>
              <input type="hidden" name="day" value="{{$day}}">
              <input type="hidden" name="date" value="{{$date}}">
              <td>
                <input type="time" name="audience">
              </td>
              <td>
                <input type="time" name="leave">
              </td>
              <td>
                <input type="text" name="break" placeholder="00:00" value="00:00">
              </td>
              <td></td>
              <td></td>
              <td>
                <input type="text" name="clarifications">
              </td>

              <td>
                <button type="submit">حفظ</button>
              </td>
            </tr>
          </form>
          @endif


          @endforeach

          @endif

        </tbody>
      </table>



    </div>
  </div>
</div>

@endsection