<?php 

include_once("./conectar.php"); 

?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />  
        <!-- <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" /> -->
        <script src="../lib/openlayers/OpenLayers.js" type="text/javascript"></script>

        <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
        
        <script type="text/javascript">
            var lon = 5;
            var lat = 40;
            var zoom = 3;
            var map, select;
            var scale = 1811995.078125;
            var municipios_layer;
            var municipios_url="municipios_json.php";

            function init()
                {
                    var options = {
                        projection: new OpenLayers.Projection("EPSG:900913"),
                        displayProjection: new OpenLayers.Projection("EPSG:4326"),
                        units: "m",
                        maxResolution: 156543.0339,
                        maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34,20037508.34, 20037508.34)
                    };
			
                    map = new OpenLayers.Map('map',options);
                    map.projection = "EPSG:900913";
                    map.displayProjection = new OpenLayers.Projection("EPSG:4326");
                    
                    var mapa = new OpenLayers.Layer.OSM("Mapa Base");
            
                    map.addLayer(mapa);
            
            
                    var municipios_format = new OpenLayers.Format.GeoJSON({}); 
            
                    var municipios_protocol = new OpenLayers.Protocol.HTTP(
                        {
                        url: municipios_url,
                        format: municipios_format
                        }
                    );
		
                    var municipios_strategy = [new OpenLayers.Strategy.Fixed()];
          
                    municipios_layer = new OpenLayers.Layer.Vector('Municipios',{
                        protocol: municipios_protocol,
			projection: map.displayProjection,
			maxScale: scale,
                        strategies: municipios_strategy
                    });

                    var municipios_style = new OpenLayers.Style({
                        'fillColor': '${color}',
			'fillOpacity': .7,
			'strokeColor': '#000000',
			'strokeWidth': 1,
			'pointRadius': '${radio}'
                    });	
			
                    var municipios_map= new OpenLayers.StyleMap({
			'default': municipios_style
			});
			
                    municipios_layer.styleMap = municipios_map;
		
           
                    map.addLayer(municipios_layer);
                    
                    
                    select = new OpenLayers.Control.SelectFeature(municipios_layer);
            
                    municipios_layer.events.on({
                        "featureselected": onFeatureSelect,
                        "featureunselected": onFeatureUnselect
                    });
            
                    map.addControl(select);
                    select.activate();
                        
                    map.addControl(new OpenLayers.Control.MousePosition({displayProjection: new OpenLayers.Projection("EPSG:4326"), numDigits: 6}));
                    map.addControl(new OpenLayers.Control.LayerSwitcher());
                    map.setCenter(new OpenLayers.LonLat(-64.036133,-16.484789).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject()),6);			
                                    
            }
        
        
        function onPopupClose(evt) {
            select.unselectAll();
        }
        
        function onFeatureSelect(event) {
            var feature = event.feature;
            var selectedFeature = feature;
            var popup = new OpenLayers.Popup.FramedCloud("chicken", 
                feature.geometry.getBounds().getCenterLonLat(),
                new OpenLayers.Size(80,80),
                "<h3>"+feature.attributes.nombre + "</h3><p>"+feature.attributes.departamento+"</p><p>Categoría: "+feature.attributes.categoria+"</p>",
                null, true, onPopupClose
            );
            feature.popup = popup;
            map.addPopup(popup);
        }
        function onFeatureUnselect(event) {
            var feature = event.feature;
            if(feature.popup) {
                map.removePopup(feature.popup);
                feature.popup.destroy();
                delete feature.popup;
            }
        }   
        
      
        
        
            </script>
        </head>
   <body onload="init()">
       <div class="titulo" align="center" >
           <h1>Municipios de Bolivia</h1>
       </div>
       <div class="principal">
       <div align="center" class="mapa">
           <div style="border: solid 1px black; width:640px; height:640px;" id="map"></div>
       </div>

   </body>
</html>
