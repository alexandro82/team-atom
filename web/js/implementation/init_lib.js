/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/2/12
 * Time: 5:27 AM
 * To change this template use File | Settings | File Templates.
 */


function init_lib() {

    $.getJSON("/dispersion/municipios.php", function(data) {
        var line,
            municipality;
        canvas = new AppCanvas({
            id : "canvas",
            width : '100',
            height : '100',
            municipalities: data
        });

        var graphic = new DispersionGraphic({
            id : "dispersion",
            width : 100,
            height : 100,
            x : 10,
            y : 10,
            canvas : canvas,
            axis : [
                {
                    x : 0,
                    y : 300,
                    width : 500,
                    height : 30,
                    minVal : 0,
                    maxVal : 100,
                    increment : 10,
                    orientation : "horizontal",
                    inverse : false,
                    canvas : canvas
                },
                {
                    x : 0,
                    y : 300,
                    width : 30,
                    height : 500,
                    minVal : 0,
                    maxVal : 100,
                    increment : 10,
                    orientation : "vertical",
                    inverse : true,
                    canvas : canvas


                }
            ]
 /*           xVariables : [
                {
                    value : 10,
                    municipalityId: "1",
                    canvas : canvas
                },
                {
                    value : 70,
                    municipalityId: "2",
                    canvas : canvas
                }
            ],
            yVariables: [
                {
                    value : 60,
                    municipalityId: "1",
                    canvas : canvas
                },
                {
                    value : 60,
                    municipalityId: "2",
                    canvas : canvas
                }
            ]*/

        });

        canvas.addElement(graphic, 40, 40);
        graphic.paint();
        initDispersion();

    });

    function initDispersion () {
        $.getJSON('/dispersion/indicadores.php', function (data) {
            var graphic,
                variables = [],
                v,
                i;

            if (canvas) {
                graphic = canvas.graphics[0];
                for (i = 0; i < 2; i += 1) {
                    for (v in data[i]) {
                        data[i][v].canvas = canvas;
                    }
                }

                variables[0] = data[0];
                variables[1] = data[1];

                graphic.loadPoints(variables[0], variables[1]);
            }
        });
    }

   /*        canvas.addElement(line);
     canvas.addElement(municipality, 10, 10);
     line.paint();

     municipality.setPosition(100, 100)
     .setRadius(5)
     .setColor("green");*/
}