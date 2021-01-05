<table>
  <thead>
    <tr>
      <th>رقم المعاملة</th>
      <th>نوع المعاملة</th>
      <th>وقت المعاملة</th>
      <th>الخدمة ذات صلة</th>
      <th>اسم المستخدم</th>
      <th>مبلغ المعاملة</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ $Item->no }}</td>
      <td>{{ $Item->type_string }}</td>
      <td>{{ date('Y/m/d H:i',strtotime($Item->created_at)) }}</td>
      <td>{{ $Item->service_title }}</td>
      <td>{{ $Item->user_name }}</td>
      <td>{{ number_format($Item->amount,2) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
