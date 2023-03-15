function getChartColorsArray(a){if(console.log(a),null!==document.getElementById(a)){var e=document.getElementById(a).getAttribute("data-colors");return(e=JSON.parse(e)).map(function(a){var e=a.replace(" ","");if(-1===e.indexOf(",")){var t=getComputedStyle(document.documentElement).getPropertyValue(e);return t||e}var r=a.split(",");return 2!=r.length?e:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(r[0])+","+r[1]+")"})}}function generateData(a,e){for(var t=0,r=[];t<a;){var n="w"+(t+1).toString(),m=Math.floor(Math.random()*(e.max-e.min+1))+e.min;r.push({x:n,y:m}),t++}return r}var chartBarColors=getChartColorsArray("basic_heatmap"),options={series:[{name:"Metric1",data:generateData(18,{min:0,max:90})},{name:"Metric2",data:generateData(18,{min:0,max:90})},{name:"Metric3",data:generateData(18,{min:0,max:90})},{name:"Metric4",data:generateData(18,{min:0,max:90})},{name:"Metric5",data:generateData(18,{min:0,max:90})},{name:"Metric6",data:generateData(18,{min:0,max:90})},{name:"Metric7",data:generateData(18,{min:0,max:90})},{name:"Metric8",data:generateData(18,{min:0,max:90})},{name:"Metric9",data:generateData(18,{min:0,max:90})}],chart:{height:450,type:"heatmap",toolbar:{show:!1}},dataLabels:{enabled:!1},colors:chartBarColors,title:{text:"HeatMap Chart (Single color)",style:{fontWeight:500}}},chart=new ApexCharts(document.querySelector("#basic_heatmap"),options);function generateData(a,e){for(var t=0,r=[];t<a;){var n=(t+1).toString(),m=Math.floor(Math.random()*(e.max-e.min+1))+e.min;r.push({x:n,y:m}),t++}return r}chart.render();var data=[{name:"W1",data:generateData(8,{min:0,max:90})},{name:"W2",data:generateData(8,{min:0,max:90})},{name:"W3",data:generateData(8,{min:0,max:90})},{name:"W4",data:generateData(8,{min:0,max:90})},{name:"W5",data:generateData(8,{min:0,max:90})},{name:"W6",data:generateData(8,{min:0,max:90})},{name:"W7",data:generateData(8,{min:0,max:90})},{name:"W8",data:generateData(8,{min:0,max:90})},{name:"W9",data:generateData(8,{min:0,max:90})},{name:"W10",data:generateData(8,{min:0,max:90})},{name:"W11",data:generateData(8,{min:0,max:90})},{name:"W12",data:generateData(8,{min:0,max:90})},{name:"W13",data:generateData(8,{min:0,max:90})},{name:"W14",data:generateData(8,{min:0,max:90})},{name:"W15",data:generateData(8,{min:0,max:90})}];data.reverse();var colors=["#f7cc53","#f1734f","#663f59","#6a6e94","#4e88b4","#00a7c6","#18d8d8","#a9d794","#46aF78","#a93f55","#8c5e58","#2176ff","#5fd0f3","#74788d","#51d28c"];colors.reverse();chartBarColors=getChartColorsArray("multiple_heatmap"),options={series:data,chart:{height:450,type:"heatmap",toolbar:{show:!1}},dataLabels:{enabled:!1},colors:chartBarColors,xaxis:{type:"category",categories:["10:00","10:30","11:00","11:30","12:00","12:30","01:00","01:30"]},title:{text:"HeatMap Chart (Different color shades for each series)",style:{fontWeight:500}},grid:{padding:{right:20}}};(chart=new ApexCharts(document.querySelector("#multiple_heatmap"),options)).render();chartBarColors=getChartColorsArray("color_heatmap"),options={series:[{name:"Jan",data:generateData(20,{min:-30,max:55})},{name:"Feb",data:generateData(20,{min:-30,max:55})},{name:"Mar",data:generateData(20,{min:-30,max:55})},{name:"Apr",data:generateData(20,{min:-30,max:55})},{name:"May",data:generateData(20,{min:-30,max:55})},{name:"Jun",data:generateData(20,{min:-30,max:55})},{name:"Jul",data:generateData(20,{min:-30,max:55})},{name:"Aug",data:generateData(20,{min:-30,max:55})},{name:"Sep",data:generateData(20,{min:-30,max:55})}],chart:{height:350,type:"heatmap",toolbar:{show:!1}},plotOptions:{heatmap:{shadeIntensity:.5,radius:0,useFillColorAsStroke:!0,colorScale:{ranges:[{from:-30,to:5,name:"Low",color:"#038edc"},{from:6,to:20,name:"Medium",color:"#51d28c"},{from:21,to:45,name:"High",color:"#564ab1"},{from:46,to:55,name:"Extreme",color:"#f7cc53"}]}}},dataLabels:{enabled:!1},stroke:{width:1},title:{text:"HeatMap Chart with Color Range",style:{fontWeight:500}},colors:chartBarColors};(chart=new ApexCharts(document.querySelector("#color_heatmap"),options)).render();chartBarColors=getChartColorsArray("shades_heatmap"),options={series:[{name:"Metric1",data:generateData(20,{min:0,max:90})},{name:"Metric2",data:generateData(20,{min:0,max:90})},{name:"Metric3",data:generateData(20,{min:0,max:90})},{name:"Metric4",data:generateData(20,{min:0,max:90})},{name:"Metric5",data:generateData(20,{min:0,max:90})},{name:"Metric6",data:generateData(20,{min:0,max:90})},{name:"Metric7",data:generateData(20,{min:0,max:90})},{name:"Metric8",data:generateData(20,{min:0,max:90})},{name:"Metric8",data:generateData(20,{min:0,max:90})}],chart:{height:350,type:"heatmap",toolbar:{show:!1}},stroke:{width:0},plotOptions:{heatmap:{radius:30,enableShades:!1,colorScale:{ranges:[{from:0,to:50,color:"#038edc"},{from:51,to:100,color:"#5fd0f3"}]}}},dataLabels:{enabled:!0,style:{colors:["#fff"]}},xaxis:{type:"category"},title:{text:"Rounded (Range without Shades)",style:{fontWeight:500}}};(chart=new ApexCharts(document.querySelector("#shades_heatmap"),options)).render();