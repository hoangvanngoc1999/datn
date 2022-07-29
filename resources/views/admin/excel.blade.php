<?php

use Faker\Core\Number;
?>
<table>
    <thead>
        <tr>
            <th style="width: 100px; text-align:center;">THÁNG</th>
            <th style="width: 100px; text-align:center;">ID SẢN PHẨM</th>
            <th style="width: 300px; text-align:center;">TÊN SẢN PHẨM</th>
            <th style="width: 200px; text-align:center;">SỐ LƯỢNG ĐÃ BÁN</th>
            <th style="width: 100px; text-align:center;">DOANH THU</th>
            <th style="width: 100px; text-align:center;">LỢI NHUẬN</th>
        </tr>
    </thead>
    <tbody>
        <?php 
         $doanhthu = 0;
         $loinhuan = 0;
        ?>
        @foreach($data as $index => $dt)
        <tr>
            <?php
            $doanhthu += ($dt->price * $dt->soluong);
            $loinhuan += (($dt->price * $dt->soluong) - ($dt->entry_price * $dt->soluong));
            $color = '#bac9d7';
            $i = $index - 1;
            if ($index == 0) {
            ?>
                <td style="width: 100px;text-align:center;">{{ $dt->MonthC .'/'.$dt->YearC }}</td>
            <?php
            } else {
            if ($data[$i]->MonthC != $dt->MonthC) {
            ?>
                <td style="width: 100px;text-align:center;">{{ $dt->MonthC .'/'.$dt->YearC }}</td>
            <?php

            } else {
            ?>
                <td style="background-color:<?=$color?>;"></td>
            <?php
            }}
            ?>
            <td style="width: 100px;text-align:center;">{{ $dt->product_id }}</td>
            <td style="width: 300px;padding-left:20px;">{{ $dt->name }}</td>
            <td style="width: 200px;text-align:center;">{{ $dt->soluong }}</td>
            <td style="width: 100px">{{ $dt->price * $dt->soluong }}</td>
            <td style="width: 100px">{{ ($dt->price * $dt->soluong) - ($dt->entry_price * $dt->soluong) }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr>
            <th rowspan="2" colspan="4" style="text-align:center;">Tổng</th>
            <th rowspan="2" style="width: 100px; text-align:center;">{{$doanhthu}}</th>
            <th rowspan="2" style="width: 100px; text-align:center;">{{$loinhuan}}</th>
        </tr>
    </tbody>
</table>