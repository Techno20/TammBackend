<table>
  <thead>
    <tr>
      <th>الاسم الكامل</th>
      <th>البريد الألكتروني</th>
      <th>الخدمات المضافة</th>
      <th>عدد الطلبات</th>
      <th>إجمالي الانفاق</th>
      <th>إجمالي الارباح</th>
      <th>تاريخ التسجيل</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ $Item->name }}</td>
      <td>{{ $Item->email }}</td>
      <td>{{ $Item->services_count }}</td>
      <td>{{ $Item->orders_count }}</td>
      <td>{{ $Item->orders_amount }}</td>
      <td>{{ $Item->profit_amount }}</td>
      <td>{{ date('Y/m/d H:i',strtotime($Item->created_at)) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
