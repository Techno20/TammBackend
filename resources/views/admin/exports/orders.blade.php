<table>
  <thead>
    <tr>
      <th>رقم الطلب</th>
      <th>تاريخ الطلب</th>
      <th>حالة الطلب</th>
      <th>اسم العميل</th>
      <th>بريد العميل</th>
      <th>اسم الخدمة</th>
      <th>اسم مزود الخدمة</th>
      <th>إجمالي الطلب</th>
      <th>إجمالي العمولة</th>
      <th>إجمالي المستحق</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Items as $Item)
    <tr>
      <td>{{ $Item->order_no }}</td>
      <td>{{ date('Y/m/d H:i',strtotime($Item->created_at)) }}</td>
      <td>{{ $Item->status_string }}</td>
      <td>{{ $Item->buyer_name }}</td>
      <td>{{ $Item->buyer_email }}</td>
      <td>{{ $Item->service_title }}</td>
      <td>{{ $Item->service_owner_name }}</td>
      <td>{{ number_format($Item->paid_total,2) }}</td>
      <td>{{ number_format($Item->commission_amount,2) }}</td>
      <td>{{ number_format($Item->net_amount,2) }}</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>
