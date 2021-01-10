<table>
  <thead>
    <tr>
      <th>اسم الخدمة</th>
      <th>اسم المستخدم</th>
      <th>بريد المستخدم</th>
      <th>التقييم من 5</th>
      <th>التعليق</th>
      <th>اسم مزود الخدمة</th>
      <th>بريد مزود الخدمة</th>
      <th>تاريخ الاضافة</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ $Item->service_title }}</td>
      <td>{{ $Item->user_name }}</td>
      <td>{{ $Item->user_email }}</td>
      <td>{{ $Item->rating }}</td>
      <td>{{ $Item->comment }}</td>
      <td>{{ $Item->service_owner_name }}</td>
      <td>{{ $Item->service_owner_email }}</td>
      <td>{{ date('Y/m/d H:i',strtotime($Item->created_at)) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
