
var BartooltipDivID = "DayBarMealEventToolTip";
function barChart(data,divID,chartType)
{

    if(chartType == "Meal") {

        $("#"+divID).remove();
        var DivToAppend = "<div id='" + divID + "'></div>";
        $("#MealChartContainer").append(DivToAppend);
        var data = [{"name": "Binge", "color": "#90CAF9", "value": data.Binge},
            {"name": "Lax", "color": "#FFD54F", "value": data.Lax},
            {"name": "Vomit", "color": "#BA68C8", "value": data.Vomit}];

        var margin = {top: 40, right: 0, bottom: 30, left: 40},
            width = 250 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom;
    }
    else if(chartType == "WeekActivity")
    {
        $("#"+divID).remove();
        var DivToAppend = "<div id='" + divID + "' ></div>";
        $("#WeekChartContainer").append(DivToAppend);

        var margin = {top: 40, right: 0, bottom: 30, left: 30},
            width = 360 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom;

        var data = [{"name": "Binge", "color": "#90CAF9", "value": data.Binge},
            {"name": "Activity Days", "color": "#FFD54F", "value": data.DaysActivity},
            {"name": "Veg Days", "color": "#7CB342", "value": data.DaysGoalVeg},
            {"name": "Good Days", "color": "#F48FB1", "value": data.GoodDays},
            {"name": "Vomit", "color": "#BA68C8", "value": data.VomitLax}];
    }



    var x = d3.scale.ordinal()
        .rangeRoundBands([0, width], .1);

    var y = d3.scale.linear()
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(5);

    var chart =  d3.select("#"+divID).append("svg")  //d3.select(".chart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


        x.domain(data.map(function(d) { return d.name; }));
        y.domain([0, d3.max(data, function(d) { return d.value; })]);

        chart.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        chart.append("g")
            .attr("class", "y axis")
            .call(yAxis);


    d3.selectAll(".tick > text")
        .style("font-size", function(d) { return 12; });


        chart.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.name); })
            .attr("y", function(d) { return y(d.value); })
            .attr("height", function(d) { return height - y(d.value); })
            .attr("width", x.rangeBand() )
            .style("fill", function(d) { return (d.color); })
            .on("mousemove", function (d) {

                d3.select(this).transition()
                    .ease("elastic")
                    .duration("1000")
                    .style("fill", function(d) { return (ColorLuminance(d.color,0.15)); }); //ColorLuminance


                var exists = document.getElementById(BartooltipDivID);
                if (exists == null) {
                    var div = ToolTip.make(BartooltipDivID);
                    document.body.appendChild(div);
                }
                var tooltipdiv = document.getElementById(BartooltipDivID);


                tooltipdiv.innerHTML =  " Type: "+ d.name
                    + "<br/> Count: " + d.value   ;
                tooltipdiv.setAttribute('style',
                    'top:' + (parseInt(d3.event.pageY) + 10)  + 'px;' +
                    'left:' + (parseInt(d3.event.pageX) + 10)  + 'px;' +
                    'border: 2px solid '+ d.color+';' +
                    'border-radius: 2px;'+
                    'background-color: #fff ;' +
                    'padding: 5px;'+
                    'opacity: 1;' +
                    'font-family: Arial,Helvetica;' +
                    'font-size: 12px;' +
                    'color: #000;'+
                    'position: absolute;');


            })
            .on("mouseout", function(d,i) {
                d3.select(this).transition()
                    .ease("elastic")
                    .duration("200")
                    .style("fill", function(d) { return (d.color); });

                var exists = document.getElementById(BartooltipDivID);
                if (exists != null) {
                    document.body.removeChild(exists);
                }
            });


    function type(d) {
        d.value = +d.value; // coerce to number
        return d;
    }


}