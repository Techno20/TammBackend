<table>
  <thead>
    <tr>
      <th>تاريخ الطلب</th>
      <th>حالة الطلب</th>
      <th>اسم المستخدم</th>
      <th>رصيد المستخدم الحالي</th>
      <th>مبلغ الطلب</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ date('Y/m/d H:i',strtotime($Item->requested_at)) }}</td>
      <td>{{ $Item->status_string }}</td>
      <td>{{ $Item->user_name }}</td>
      <td>{{ $Item->user_balance }}</td>
      <td>{{ number_format($Item->amount,2) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
