<?= $this->layout("templates/panel", []); ?>




<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/locales/de_DE.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/germanyLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/fonts/notosans-sc.js"></script>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>



<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(10, 1fr);
        gap: 8px;
        width: 100%;
        height: calc(100vh - 100px);
    }






    .div6 {
        grid-column: span 2 / span 2;
        grid-row: span 9 / span 9;
        padding-top: 1.2rem;


        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
    }

    .div7 {
        grid-column: span 3 / span 3;
        grid-row: span 4 / span 4;
        grid-column-start: 3;

        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gp-status-in-day {
        grid-column: span 2 / span 2;
        grid-row: span 5 / span 5;
        grid-column-start: 3;
        grid-row-start: 6;


        height: 100%;
        display: flex;
        align-items: center;

    }

    .div9 {
        grid-row: span 5 / span 5;
        grid-column-start: 5;
        grid-row-start: 6;
    }
</style>




<style>
    .cp-styled {
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 12px;
    }

    .habit-champion {
        background: #fff;
        color: black;
        padding: 1rem;
        transition: transform 0.4s ease;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .habit-champion .hc-icon {
        margin-right: 10px;
        background: #F3FBCD;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .habit-champion .hc-habit-count {
        margin-left: 1rem;
    }

    .habit-champion .hc-habit-count .hc-habit {
        font-weight: bold;
        color: rgb(163, 163, 163);
    }

    #chartdiv {
        width: 100%;
        height: 340px;
    }

    #evolucao {
        width: 90%;
        height: 100%;
    }

    #more-doned {
        width: 100%;
        height: 100%;
    }




    .lh-card {
        width: 80%;
        height: 160px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 2px 3px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 0 10px;
    }

    .card-wrapper {
        display: inline-flex;
        flex-wrap: nowrap;
        align-items: center;
        width: 100%;
    }

    .card-icon {
        width: 20%;
    }

    .card-icon .icon-cart-box {
        background-color: #e0f2f1;
        width: 3em;
        height: 3em;
        border-radius: 50%;
        text-align: center;
        padding: 15px 0px;
        margin: 0 auto;
    }

    .card-content {
        width: 80%;
    }

    .card-title-wrapper {
        display: inline-flex;
        flex-wrap: nowrap;
        align-items: baseline;
        width: 100%;
    }

    .card-title {
        width: 95%;
        font-size: 1em;
        font-weight: 600;
        color: #333;
        padding: 8px 0 0 10px;
    }

    .card-action {
        width: 5%;
        text-align: right;
        padding: 0 30px;
    }

    .card-action svg {
        cursor: pointer;
        fill: rgba(0, 0, 0, 0.2);
        transition: 0.3s ease-in-out;
    }

    .card-action svg:hover {
        fill: rgba(0, 0, 0, 0.6);
    }

    .product-name {
        font-size: 0.8em;
        color: #757575;
        padding: 5px 0 0 10px;
    }

    .product-name:hover {
        cursor: pointer;
        text-decoration: underline;
    }

    .product-price {
        font-size: 0.9em;
        font-weight: 600;
        color: #333;
        padding: 0 0 10px 10px;
    }

    .btn-view-cart {
        font-size: 0.7em;
        font-weight: 600;
        padding: 8px 10px 5px 10px;
        /* margin: 5px 10px 20px; */
        margin-left: 10px;
        border-radius: 8px;
        color: #009688;
        border: 1px solid #009688;
        background-color: #e0f2f1;
        box-shadow: none;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.4s ease-in-out;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-view-cart:hover,
    .btn-view-cart:active,
    .btn-view-cart:focus {
        color: white;
        background-color: #009688;
        border: 1px solid #009688;
    }



    .btn-forgot {
        font-size: 0.7em;
        font-weight: 600;
        padding: 8px 10px 5px 10px;
        /* margin: 5px 10px 20px; */
        margin-left: 10px;
        border-radius: 8px;
        color: rgb(150, 0, 0);
        border: 1px solid rgb(150, 0, 0);
        background-color: rgb(242, 224, 224);
        box-shadow: none;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.4s ease-in-out;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-forgot:hover,
    .btn-forgot:active,
    .btn-forgot:focus {
        color: white;
        background-color: rgb(150, 0, 0);
        border: 1px solidrgb(150, 0, 0);
    }
</style>


<div class="parent">
    <div class="cp-styled habit-champion">
        <div class="hc-icon">🏆</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Leitura</div>
            <div class="hc-count"><b>245</b> dias seguidos</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">👻</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Passear com Olga</div>
            <div class="hc-count"><b>12</b> dias atrás</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">🎉</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Concluídos Hoje</div>
            <div class="hc-count"><b>24</b> Hábitos</div>
        </div>
    </div>


    <div class="cp-styled habit-champion">
        <div class="hc-icon">🤨</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Pendentes Hoje</div>
            <div class="hc-count"><b>13</b> hábitos</div>
        </div>
    </div>

    <div class="cp-styled habit-champion">
        <div class="hc-icon">🎉</div>
        <div class="hc-habit-count">
            <div class="hc-habit">Ativos</div>
            <div class="hc-count"><b>20</b> hábitos ativos</div>
        </div>
    </div>







    <div class="cp-styled div6 list-habits">
        <h5 class="mt-3 text-muted">🚀 Hábitos Pendentes (Hoje)</h5>
        <div class="lh-card">
            <div class="card-wrapper">
                <div class="card-icon">
                    <div class="icon-cart-box">
                        <i class="ph ph-person-simple-run"></i>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title-wrapper">
                        <span class="card-title mt-3">Háb. Corrida</span>
                    </div>
                    <div class="product-name">Realizar uma corrida básica de 1km</div>
                    <div class="product-price">Em <b>45 minutos </b></div>
                    <div class="d-flex">
                        <button class="btn-view-cart mb-4" type="button">Concluir <i class="ms-1 ph ph-checks"></i></button>
                        <button class="btn-forgot mb-4" type="button">Pular <i class="ms-1 ph ph-x"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lh-card">
            <div class="card-wrapper">
                <div class="card-icon">
                    <div class="icon-cart-box">
                        <i class="ph ph-person-simple-run"></i>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title-wrapper">
                        <span class="card-title mt-3">Háb. Corrida</span>
                    </div>
                    <div class="product-name">Realizar uma corrida básica de 1km</div>
                    <div class="product-price">Em <b>45 minutos </b></div>
                    <div class="d-flex">
                        <button class="btn-view-cart mb-4" type="button">Concluir <i class="ms-1 ph ph-checks"></i></button>
                        <button class="btn-forgot mb-4" type="button">Pular <i class="ms-1 ph ph-x"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lh-card">
            <div class="card-wrapper">
                <div class="card-icon">
                    <div class="icon-cart-box">
                        <i class="ph ph-person-simple-run"></i>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-title-wrapper">
                        <span class="card-title mt-3">Háb. Corrida</span>
                    </div>
                    <div class="product-name">Realizar uma corrida básica de 1km</div>
                    <div class="product-price">Em <b>45 minutos </b></div>
                    <div class="d-flex">
                        <button class="btn-view-cart mb-4" type="button">Concluir <i class="ms-1 ph ph-checks"></i></button>
                        <button class="btn-forgot mb-4" type="button">Pular <i class="ms-1 ph ph-x"></i></button>
                    </div>
                </div>
            </div>
        </div>

     

    </div>
    <div class="div7 cp-styled">
        <div id="evolucao"></div>
    </div>
    <div class="cp-styled gp-status-in-day">
        <div id="chartdiv"></div>
    </div>
    <div class="cp-styled div9">
        <div id="more-doned"></div>
    </div>
</div>




<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");
        root._logo.dispose();


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout,
            innerRadius: am5.percent(50)
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            alignLabels: false
        }));

        series.labels.template.setAll({
            textType: "circular",
            centerX: 0,
            centerY: 0
        });


        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll([{
                value: 10,
                category: "Concluídos"
            },
            {
                value: 2,
                category: "Pendentes"
            },
        ]);


        // Create legend
        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15,
        }));

        legend.data.setAll(series.dataItems);


        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
        series.appear(1000, 100);

    }); // end am5.ready()
</script>










<!-- evolucao -->
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("evolucao");
        root._logo.dispose();

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true,
            paddingLeft: 0
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "none"
        }));
        cursor.lineY.set("visible", false);


        // Generate random data
        var date = new Date();
        date.setHours(0, 0, 0, 0);
        var value = 100;

        function generateData() {
            value = Math.round((Math.random() * 10 - 5) + value);
            am5.time.add(date, "day", 1);
            return {
                date: date.getTime(),
                value: value
            };
        }

        function generateDatas(count) {
            var data = [];
            for (var i = 0; i < count; ++i) {
                data.push(generateData());
            }
            return data;
        }


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0.5,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {
                minGridDistance: 80,
                minorGridEnabled: true,
                pan: "zoom"
            }),
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 1,
            renderer: am5xy.AxisRendererY.new(root, {
                pan: "zoom"
            })
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
            name: "Series",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            sequencedInterpolation: true,
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        series.strokes.template.setAll({
            strokeWidth: 2,
        });

        series.bullets.push(function() {
            return am5.Bullet.new(root, {
                locationY: 0,
                sprite: am5.Circle.new(root, {
                    radius: 4,
                    stroke: root.interfaceColors.get("background"),
                    strokeWidth: 2,
                    fill: series.get("fill")
                })
            });
        });


        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));


        var data = generateDatas(15);
        series.data.setAll(data);


        var container = chart.plotContainer.children.push(am5.Container.new(root, {
            layout: root.horizontalLayout,
            position: "absolute",
            x: 20,
            y: am5.percent(100),
            centerY: am5.percent(100),
            width: am5.percent(30),
            paddingLeft: 30,
            paddingRight: 30,
            paddingTop: 20,
            paddingBottom: 30
        }))

        // Add a label
        container.children.push(am5.Label.new(root, {
            text: "Smoothing:",
            centerY: am5.percent(50),
            paddingBottom: 10
        }));

        // add slider for smoothing
        var smoothingSlider = container.children.push(am5.Slider.new(root, {
            orientation: "horizontal",
            centerY: am5.percent(50),
            start: 1 - series.get("tension", 0.5)
        }));


        smoothingSlider.on("start", function(start) {
            series.set("tension", 1 - start);
        })

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>




<!-- deitado -->
<script>
    am5.ready(function() {
        // Create root element
        var root = am5.Root.new("more-doned");
        root._logo.dispose();

        // Set themes
        root.setThemes([am5themes_Animated.new(root)]);

        // Create chart
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomY",
                layout: root.verticalLayout
            })
        );

        // Create Y axis (categories)
        var yAxis = chart.yAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "category",
                renderer: am5xy.AxisRendererY.new(root, {
                    minGridDistance: 20,
                    inversed: true, // <- Aqui está a mudança!

                })
            })
        );

        // Create X axis (values)
        var xAxis = chart.xAxes.push(
            am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererX.new(root, {})
            })
        );

        // Create series (bars)
        var series = chart.series.push(
            am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueXField: "value",
                categoryYField: "category"
            })
        );

        // Set data
        var data = [{
                category: "Hábito A",
                value: 45
            },
            {
                category: "Hábito B",
                value: 70
            },
            {
                category: "Hábito C",
                value: 55
            },
            {
                category: "Hábito D",
                value: 90
            },
            {
                category: "Hábito E",
                value: 90
            },
            {
                category: "Hábito F",
                value: 90
            },
            {
                category: "Hábito G",
                value: 90
            },
            {
                category: "Hábito H",
                value: 90
            }
        ];

        // Ordenar do maior para o menor
        data.sort((a, b) => b.value - a.value);

        yAxis.data.setAll(data);
        series.data.setAll(data);

        // Animate
        series.appear(1000);
        chart.appear(1000, 100);
    });
</script>