
 'use strict';

 (function () {
   let cardColor, headingColor, legendColor, labelColor, borderColor;
   if (isDarkStyle) {
     cardColor = config.colors_dark.cardColor;
     labelColor = config.colors_dark.textMuted;
     legendColor = config.colors_dark.bodyColor;
     headingColor = config.colors_dark.headingColor;
     borderColor = config.colors_dark.borderColor;
   } else {
     cardColor = config.colors.cardColor;
     labelColor = config.colors.textMuted;
     legendColor = config.colors.bodyColor;
     headingColor = config.colors.headingColor;
     borderColor = config.colors.borderColor;
   }

   function chartSws(arName, arData, dtActive) {
    return {
      chart: {
        height: 380,
        type: 'radialBar'
      },
      colors: [config.colors.success, config.colors.danger, config.colors.warning],
      plotOptions: {
        radialBar: {
          size: 185,
          hollow: {
            size: '40%'
          },
          track: {
            margin: 10,
            background: config.colors_label.secondary
          },
          dataLabels: {
            name: {
              fontSize: '2rem',
              fontFamily: 'Open Sans'
            },
            value: {
              fontSize: '1.2rem',
              color: legendColor,
              fontFamily: 'Open Sans'
            },
            total: {
              show: true,
              fontWeight: 400,
              fontSize: '1.3rem',
              color: headingColor,
              label: 'Lunas',
              formatter: function (d) {
                return dtActive;
              }
            }
          }
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: -25,
          bottom: -20
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      stroke: {
        lineCap: 'round'
      },
      series: arData,
      labels: arName
    };
   }

  function EarningReportsBarChart(arrayName, arrayData, dtActive) {
    const basicColor = config.colors_label.primary,
      highlightColor = config.colors.primary;
    var colorArr = [];

    for (let i = 0; i < arrayData.length; i++) {
      if (i === dtActive) {
        colorArr.push(highlightColor);
      } else {
        colorArr.push(basicColor);
      }
    }

    const earningReportBarChartOpt = {
      chart: {
        height: 258,
        parentHeightOffset: 0,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '32%',
          startingShape: 'rounded',
          borderRadius: 7,
          distributed: true,
          dataLabels: {
            position: 'top'
          }
        }
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          bottom: 0,
          left: -10,
          right: -10
        }
      },
      colors: colorArr,
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        offsetY: -25,
        style: {
          fontSize: '15px',
          colors: [legendColor],
          fontWeight: '600',
          fontFamily: 'Public Sans'
        }
      },
      series: [
        {
          data: arrayData
        }
      ],
      legend: {
        show: false
      },
      tooltip: {
        enabled: false
      },
      xaxis: {
        categories: arrayName,
        axisBorder: {
          show: true,
          color: borderColor
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px',
            fontFamily: 'Public Sans'
          }
        }
      },
      yaxis: {
        labels: {
          offsetX: -15,
          formatter: function (val) {
            return parseInt(val);
            // return '$' + parseInt(val / 1) + 'k';
          },
          style: {
            fontSize: '13px',
            colors: labelColor,
            fontFamily: 'Public Sans'
          },
          min: 0,
          max: 60000,
          tickAmount: 6
        }
      },
      responsive: [
        {
          breakpoint: 1441,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '41%'
              }
            }
          }
        },
        {
          breakpoint: 590,
          options: {
            plotOptions: {
              bar: {
                columnWidth: '61%',
                borderRadius: 5
              }
            },
            yaxis: {
              labels: {
                show: false
              }
            },
            grid: {
              padding: {
                right: 0,
                left: -20
              }
            },
            dataLabels: {
              style: {
                fontSize: '12px',
                fontWeight: '400'
              }
            }
          }
        }
      ]
    };
    return earningReportBarChartOpt;
  }

  
  // api
   var fd2 = $.ajax({ url: '/api/chart-pby', dataType: 'json', async: false }).responseJSON;
   
   // --------------------------------------------------------------------
   const earningReportsTabsOrdersEl = document.querySelector('#earningReportsTabsOrders'),
    earningReportsTabsOrdersConfig = EarningReportsBarChart(fd2.name, fd2.count, fd2.active);

    if (typeof earningReportsTabsOrdersEl !== undefined && earningReportsTabsOrdersEl !== null) {
      const earningReportsTabsOrders = new ApexCharts(earningReportsTabsOrdersEl, earningReportsTabsOrdersConfig);
      earningReportsTabsOrders.render();
    }
 
 })();