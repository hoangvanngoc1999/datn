@extends('layout.admin')
@section('main')
<h3>Dashboard</h3>
<hr>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
.panel {
    box-shadow: 0 2px 0 rgba(0, 0, 0, 0.05);
    border-radius: 0;
    border: 0;
    margin-bottom: 24px;
}

.panel-dark.panel-colorful {
    background-color: #3b4146;
    border-color: #3b4146;
    color: #fff;
}

.panel-danger.panel-colorful {
    background-color: #f76c51;
    border-color: #f76c51;
    color: #fff;
}

.panel-primary.panel-colorful {
    background-color: #5fa2dd;
    border-color: #5fa2dd;
    color: #fff;
}

.panel-info.panel-colorful {
    background-color: #4ebcda;
    border-color: #4ebcda;
    color: #fff;
}

.panel-body {
    padding: 25px 20px;
}

.panel hr {
    border-color: rgba(0, 0, 0, 0.1);
}

.mar-btm {
    margin-bottom: 15px;
}

h2,
.h2 {
    font-size: 28px;
}

.small,
small {
    font-size: 85%;
}

.text-sm {
    font-size: .9em;
}

.text-thin {
    font-weight: 300;
}

.text-semibold {
    font-weight: 600;
}
</style>
<form class="form-inline" style="justify-content: space-between">
    <div class="form-group">
        &emsp;<label for="">Xem doanh thu ngày : </label>&emsp;
        <input type="date" style="padding-right: 100px;" class="form-control" name="chooseDay"
            placeholder="Search by name....">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="form-group">
        <button class="btn btn-success"><a href="{{Route('admin.exportExcel')}}" style="color:white"> export
                Excel</a></button>
    </div>
</form>
<hr>
<div class="container bootstrap snippets bootdey" style="max-width:100%">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('order.index')}}">
                <div class="panel panel-primary panel-colorful">
                    <div class="panel-body text-center">
                        <p class="text-uppercase mar-btm text-sm">Hoá đơn trong ngày</p>
                        <i class="fa fa-cart-plus fa-5x"></i>
                        <hr>
                        <p class="h2 text-thin"><?= (string) number_format($data['orderToday']) ?></p>
                        <!-- <small><span class="text-semibold"><i class="fa fa-shopping-cart fa-fw"></i> 954</span> Sales in this month</small> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-danger panel-colorful">
                <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Doanh thu trong ngày</p>
                    <i class="fa fa-dollar fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?= (string) number_format($data['revenueToday']) ?></p>
                    <!-- <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> 154</span> Unapproved comments</small> -->
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-danger panel-colorful">
                <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Lợi nhuận trong ngày</p>
                    <i class="fa fa-dollar fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?= (string) number_format($data['profitToday']) ?></p>
                    <!-- <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> 154</span> Unapproved comments</small> -->
                </div>
            </div>
        </div> --}}
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('guest.index')}}">
                <div class="panel panel-dark panel-colorful">
                    <div class="panel-body text-center">
                        <p class="text-uppercase mar-btm text-sm">Tổng khách hàng trong ngày</p>
                        <i class="fa fa-users fa-5x"></i>
                        <hr>
                        <p class="h2 text-thin"><?= (string) number_format($data['customer']) ?></p>
                        <!-- <small><span class="text-semibold">7%</span> Higher than yesterday</small> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('product.index')}}">
                <div class="panel panel-info panel-colorful">
                    <div class="panel-body text-center">
                        <p class="text-uppercase mar-btm text-sm">Tổng sản phẩm đã bán trong ngày</p>
                        <i class="fa fa-comment fa-5x"></i>
                        <hr>
                        <p class="h2 text-thin"><?= (string) number_format($data['product']) ?></p>
                        <!-- <small><span class="text-semibold"><i class="fa fa-dollar fa-fw"></i> 22,675</span> Total Earning</small> -->
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container bootstrap snippets bootdey" style="max-width:100%">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('category.index')}}">
                <div class="panel panel-dark panel-colorful">
                    <div class="panel-body text-center">
                        <p class="text-uppercase mar-btm text-sm">Lợi nhuận trong ngày</p>
                        <i class="fa fa-bar-chart fa-5x"></i>
                        <hr>
                        <p class="h2 text-thin"><?= (string) number_format($data['category']) ?></p>
                        <!-- <small><span class="text-semibold">7%</span> Higher than yesterday</small> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('order.index')}}">
                <div class="panel panel-primary panel-colorful">
                    <div class="panel-body text-center">
                        <p class="text-uppercase mar-btm text-sm">Tổng hoá đơn</p>
                        <i class="fa fa-shopping-cart fa-5x"></i>
                        <hr>
                        <p class="h2 text-thin"><?= (string) number_format($data['order']) ?></p>
                        <!-- <small><span class="text-semibold"><i class="fa fa-shopping-cart fa-fw"></i> 954</span> Sales in this month</small> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-danger panel-colorful">
                <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Tổng hoá đơn thành công</p>
                    <i class="fa fa-check-square fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?= (string) number_format($data['orderSuccess']) ?></p>
                    <!-- <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> 154</span> Unapproved comments</small> -->
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-info panel-colorful">
                <div class="panel-body text-center">
                    <p class="text-uppercase mar-btm text-sm">Tổng doanh thu</p>
                    <i class="fa fa-area-chart fa-5x"></i>
                    <hr>
                    <p class="h2 text-thin"><?= (string) number_format($data['revenue']) ?></p>
                    <!-- <small><span class="text-semibold"><i class="fa fa-dollar fa-fw"></i> 22,675</span> Total Earning</small> -->
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<table class="table table-hover">
    <br>
    <h2>Khách hàng thân thiết:</h2>
    <br>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Tổng hoá đơn đã mua</th>
            <th>Tổng tiền tích lũy</th>
            <th class="text-right">Trạng thái</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($customer as $ctm) { ?>
        <tr>
            <td>{{$ctm['customer_id']}}</td>
            <td>{{$ctm['name']}}</td>
            <td>{{$ctm['email']}}</td>
            <td>{{$ctm['countOrder']}}</td>
            <td>{{$ctm['sumPrice']}}</td>
            <td class="text-right">
                <!-- <span class="badge badge-danger">Block</span> -->
                <span class="badge badge-success">Active</span>
            </td>
        </tr>
        <?php } ?>

    </tbody>
</table>
<br>
<div>
    {{$customer->appends(request()->all())->links()}}
</div>
<hr>
<br>
<H2>Biểu đồ doanh thu:</H2>
<br>
<form class="form-inline">
    <div class="form-group">
        <label for="">Từ ngày : </label>&emsp;
        <input type="date" style="padding-right: 100px;" class="form-control" name="dayStart"
            placeholder="Search by name....">
        &emsp;<label for="">Đến ngày : </label>&emsp;
        <input type="date" style="padding-right: 100px;" class="form-control" name="dayEnd"
            placeholder="Search by name....">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
<br>
<form class="form-inline">
    <div class="form-group">
        <label for="">Thống kê tháng : </label>&emsp;
        <select name="chooseMonth" class="form-control">
            <option selected value="0">chọn tháng</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
<hr>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
            role="tab" aria-controls="home-tab-pane" aria-selected="true">Tháng</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button"
            role="tab" aria-controls="profile-tab-pane" aria-selected="false">Năm</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div style="max-height: 400px;">
            <canvas id="myChart" style="max-height: 400px;"></canvas>
        </div>
    </div>
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div style="max-height: 400px;">
            <canvas id="myChart2" style="max-height: 400px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let labels = <?= $chartMonth['labels'] ?>;
let dataC = <?= $chartMonth['dataC'] ?>;

const data = {
    labels: labels,
    datasets: [{
        label: 'Thống kê doanh thu tháng {{$chartMonth["month"]}}',
        backgroundColor: '#2e8ae7',
        borderColor: '#1571cf',
        data: dataC,
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {}
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);

let labelsY = <?= $chartYear['labels'] ?>;
let dataY = <?= $chartYear['dataY'] ?>;

const data2 = {
    labels: labelsY,
    datasets: [{
        label: 'Thống kê doanh thu năm {{$chartYear["year"]}}',
        backgroundColor: '#2e8ae7',
        borderColor: '#1571cf',
        data: dataY,
    }]
};
const config2 = {
    type: 'bar',
    data: data2,
    options: {}
};
const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
);
</script>
@stop()