

var randomColor = (function(){
    var golden_ratio_conjugate = 0.618033988749895;
    var h = Math.random();

    var hslToRgb = function (h, s, l){
        var r, g, b;

        if(s == 0){
            r = g = b = l; // achromatic
        }else{
            function hue2rgb(p, q, t){
                if(t < 0) t += 1;
                if(t > 1) t -= 1;
                if(t < 1/6) return p + (q - p) * 6 * t;
                if(t < 1/2) return q;
                if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            }

            var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            var p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }

        return '#'+Math.round(r * 255).toString(16)+Math.round(g * 255).toString(16)+Math.round(b * 255).toString(16);
    };

    return function(){
        h += golden_ratio_conjugate;
        h %= 1;
        return hslToRgb(h, 0.5, 0.60);
    };
})();
var tooltipDivID = "DayEventToolTip";

var ToolTip = {};
ToolTip.make = function (unique_id) {
    var div = document.createElement("div");
    div.setAttribute("id", unique_id);
    div.setAttribute("class", "ToolTip");//style
    return div;
};

function LineChart(data) {


 $("#DayLineChart").remove();

 $("#dayLineChartContainer").append("<div id ='DayLineChart'></div>");

  var  data = d3.nest()
        .key(function(d) { return d.Type; })
        .entries(data);


    var parseDate = d3.time.format("%Y-%m-%dT%H:%M:%S-04:00").parse,
        bisectDate = d3.bisector(function(d) { return d.date; }).left,
        formatValue = d3.format(",.2f"),
        formatCurrency = function(d) { return "" + formatValue(d); };

    var mins= [], maxs=[];
    var miny =[], maxy=[];
    var circlesData  =[];
    for(var i =0; i< data.length;i++)
    {
        var mdata = data[i].values;

         var color  = randomColor();
        data[i].color = color;

        data[i].values.forEach(function(d) {
            d.date = parseDate(d.TimeOfEvent);
            d.Minutes = +d.Minutes;
            d.color = color;
            circlesData.push(d);
        });

        data[i].values.sort(function(a, b) {
            return a.date - b.date;
        });


        mins.push(data[i].values[0].date);
        maxs.push(data[i].values[data[i].values.length -1].date);

        data[i].values.sort(function(a, b) {
            return a.Minutes - b.Minutes;
        });

        miny.push(data[i].values[0].Minutes);
        maxy.push(data[i].values[data[i].values.length -1].Minutes);
    }


    mins.sort(function(a, b) {
        return a - b;
    });

    maxs.sort(function(a, b) {
        return a - b;
    });


    miny.sort(function(a, b) {
        return a - b;
    });

    maxy.sort(function(a, b) {
        return a - b;
    });



    var margin = {top: 30, right: 50, bottom: 30, left: 50},
        width = 487 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;


    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    xAxis.ticks(2)

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");



    var line = d3.svg.line()
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.Minutes); });



    var svg = d3.select("#DayLineChart").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


       // if (error) throw error;


    x.domain([mins[0], maxs[maxs.length - 1]]);
    y.domain([miny[0],(maxy[maxy.length - 1]+ 20)] );


    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", -45)
        .attr("dy", ".71em")
        .style("text-anchor", "end")
        .text("Minutes");


    for(var i =0; i< data.length;i++)
    {
       var mdata = data[i].values;
       var color = data[i].color;

        mdata.sort(function(a, b) {
            return a.date - b.date;
        });



        svg.append("path")
            .datum(mdata)
            .attr("class", "line")
            .attr("d", line)
            .style({stroke:color} );



    }

    d3.selectAll(".tick > text")
        .style("font-size", function(d) { return 12; });



    var circles = svg.selectAll("circle")
        .data(circlesData)
        .enter()
        .append("circle");

    var circleAttributes = circles
        .attr("cx", function (d) { return x(d.date); })
        .attr("cy", function (d) { return y(d.Minutes); })
        .attr("r", function (d) { return 1.5; })
        .style("fill", function(d) { return d.color; })
        .on("mouseover", function (d) {
            d3.select(this).transition()
                .ease("elastic")
                .duration("500")
                .attr("r", 5);


            var exists = document.getElementById(tooltipDivID);
            if (exists == null) {
                var div = ToolTip.make(tooltipDivID);
                document.body.appendChild(div);
            }
            var tooltipdiv = document.getElementById(tooltipDivID);


            tooltipdiv.innerHTML =  moment(new Date( d.date )).format("MMM Do hh:mm a")
                 + " <br/> Type: "+ d.Type
                 + "<br/> Minutes: " + d.Minutes   ;
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
                .ease("quad")
                .delay("100")
                .duration("200")
                .attr("r", 1.5);


            var exists = document.getElementById(tooltipDivID);
            if (exists != null) {
                document.body.removeChild(exists);
            }

        });





}