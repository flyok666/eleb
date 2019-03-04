@extends('admin.layout.default')

@section('contents')
    <script src="https://cdn.bootcss.com/echarts/4.1.0-release/echarts.min.js"></script>
    <h1>最近一周订单量统计</h1>
    <table class="table table-bordered">
        <tr>
            @foreach($datas as $date=>$amount)
            <th>{{ $date }}</th>
                @endforeach
        </tr>
        <tr>
            @foreach($datas as $date=>$amount)
            <td>{{ $amount }}</td>
            @endforeach
        </tr>
    </table>

    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 1000px;height:400px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '最近一周订单量统计'
            },
            tooltip: {},
            legend: {
                data:['订单量']
            },
            xAxis: {
                data: {!! json_encode(array_keys($datas)) !!}
            },
            yAxis: {},
            series: [{
                name: '订单量',
                type: 'line',
                data: {!! json_encode(array_values($datas)) !!}
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>

    @stop