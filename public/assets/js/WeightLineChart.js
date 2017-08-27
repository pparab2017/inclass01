

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


function WeightLineChart(data) {

     $("#WeekLineChart").remove();
     $("#WeekChartContainer").append("<div id='WeekLineChart' style='border-bottom: 1px dashed #eee' ></div>");


    var minx = 0, maxx =0 , miny =0,maxy = 0;
    var circlesData  =[];
    for(var i =0; i< data.length;i++)
    {
        var color  = randomColor();
        data[i].color = color;

        data.forEach(function(d) {
            d.key = d.key;
            d.values.Weight = +d.values.Weight;
            d.color = color;
            circlesData.push(d);
        });

        data.sort(function(a, b) {
            return a.key - b.key;
        });

        minx = data[0].key;
        maxx = data[data.length - 1].key;

        data.sort(function(a, b) {
            return a.values.Weight - b.values.Weight;
        });
        miny = data[0].values.Weight;
        maxy = data[data.length-1].values.Weight;

    }



    var margin = {top: 30, right: 20, bottom: 30, left: 30},
        width = 360 - margin.left - margin.right,
        height = 200 - margin.top - margin.bottom;


    var x = d3.scale.linear()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");
        xAxis.ticks(3);

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");
        yAxis.ticks(5)


    var line = d3.svg.line()
        .x(function(d) { return x(d.key); })
        .y(function(d) { return y(d.values.Weight); });

    var svg = d3.select("#WeekLineChart").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    x.domain([minx, maxx]);
    y.domain([miny ,maxy ]);


    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 5)
        .attr("dy", ".71em")
        .style("text-anchor", "end")
        .text("Weight");

        data.sort(function(a, b) {
            return a.key - b.key;
        });

        svg.append("path")
            .datum(data)
            .attr("class", "line")
            .attr("d", line)
            .style({stroke:color});

    d3.selectAll(".tick > text")
        .style("font-size", function(d) { return 12; });

    var circles = svg.selectAll("circle")
        .data(circlesData)
        .enter()
        .append("circle");

    var circleAttributes = circles
        .attr("cx", function (d) { return x(d.key); })
        .attr("cy", function (d) { return y(d.values.Weight); })
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


            tooltipdiv.innerHTML = "Week: "+ d.key
                + "<br/> Weight: " + d.values.Weight   ;
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