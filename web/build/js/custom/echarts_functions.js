// 1. Init common functions on document ready

$(function() {
  "use strict";
  // page onload functions
  echarts_bar.init();
});

echarts_bar = {
  init: function() {
    var $elem = $("[data-echarts-bar],.data-echarts-bar");
    if ($elem.length) {
      $elem.each(function() {
        var $this = this,
          this_title = $($this).data('title'),
          this_data = $($this).data('values');
        var $myChart = echarts.init($this);
        option = {
          color: ['#e53935', '#3398DB'],
          tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
              type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
          },
          grid: {
            bottom: '10%',
            containLabel: true
          },
          dataZoom: [{
            type: 'inside'
          }, {
            start: 0,
            end: 10,
            handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            handleSize: '80%',
            handleStyle: {
              color: '#fff',
              shadowBlur: 3,
              shadowColor: 'rgba(0, 0, 0, 0.6)',
              shadowOffsetX: 2,
              shadowOffsetY: 2
            }
          }],
          xAxis: [{
            type: 'category',
            data: jQuery.map(this_data, function(n, i) {
              return (n.name);
            }),
            axisTick: {
              alignWithLabel: true
            }
          }],
          yAxis: [{
            type: 'value'
          }],
          series: [{
            type: 'bar',
            data: jQuery.map(this_data, function(n, i) {
              return (n.value);
            })
          }]
        };
        $myChart.setOption(option);
      });

    }
  }
}
echarts_pie = {
  init: function() {
    var $elem = $("[data-echarts-pie],.data-echarts-pie");
    if ($elem.length) {
      $elem.each(function() {
        var $this = this,
          this_title = $($this).data('title'),
          this_data = $($this).data('values');
        var $myChart = echarts.init($this);
        option = {
          color: ['#39f', '#00bfa5', '#80d8ff', '#00b8d4'],
          title: {
            text: this_title,
            left: 'center',
            top: 20,
            textStyle: {
              color: '#444'
            }
          },
          legend: {
            x: 'center',
            y: 'bottom',
            data: jQuery.map(this_data, function(n, i) {
              return (n.name);
            })
          },
          toolbox: {
            show: true,
            feature: {
              saveAsImage: {
                title: ' ',
                show: true
              }
            }
          },
          tooltip: {
            trigger: 'item',
            formatter: "{b} : {d}%"
          },
          series: [{
            name: this_title,
            data: this_data,
            type: 'pie',
            radius: [20, 100],
            center: ['50%', '50%'],
            roseType: 'radius',
            label: {
              normal: {
                textStyle: {
                  color: 'rgb(68, 68, 68)'
                }
              }
            },
            labelLine: {
              normal: {
                lineStyle: {
                  color: 'rgb(68, 68, 68)'
                },
                smooth: 0,
                length: 30,
                length2: 30
              }
            },
            itemStyle: {
              normal: {
                shadowColor: 'rgba(0, 0, 0, 0.6)'
              }
            },
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function(idx) {
              return Math.random() * 200;
            }
          }]
        };
        $myChart.setOption(option);
      });
    }
  }
};
