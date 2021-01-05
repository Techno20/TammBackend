<table>
  <thead>
    <tr>
      <th>اسم الخدمة</th>
      <th>التصنيف</th>
      <th>الموافقة</th>
      <th>اسم مزود الخدمة</th>
      <th>عدد الطلبات</th>
      <th>السعر</th>
      <th>تاريخ الاضافة</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ $Item->title }}</td>
      <td>{{ $Item->category_name }}</td>
      <td>{{ ($Item->is_approved) ? 'مفعل' : 'غير مفعل' }}</td>
      <td>{{ $Item->user_name }}</td>
      <td>{{ $Item->orders_count }}</td>
      <td>{{ number_format($Item->basic_price,2) }}</td>
      <td>{{ date('Y/m/d H:i',strtotime($Item->created_at)) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
