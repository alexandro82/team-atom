/**
 * Created with JetBrains WebStorm.
 * User: thaer
 * Date: 12/1/12
 * Time: 3:24 PM
 * To change this template use File | Settings | File Templates.
 */

var Municipality = function (options) {
    GenericObject.call(this, options);
    this.municipalityName = "";
    this.category = "";
    this.code = -1;
    this.dept = "";
    this.selected = false;
    this.info = null;

    Municipality.prototype.initObject.call(this, options);
};

Municipality.prototype = new GenericObject();

Municipality.prototype.initObject = function (options) {
    var defaults = {
        nombre : "Municipio",
        categoria : "D",
        codigo : -1,
        departamento : "La Paz",
        width : 14,
        height : 14,

    };
    $.extend(true, defaults, options);

    this.setMunicipalityName(defaults.nombre)
        .setCategory(defaults.categoria)
        .setCode(defaults.codigo)
        .setDept(defaults.departamento)
        .setDimension(defaults.width, defaults.height);
};

Municipality.prototype.paint = function () {

    if (!this.html) {
        return this;
    }
    if (this.selected) {
        //this.html.style.backgroundImage = "url(js/implementation/img/municipio_verde.jpg";
        //this.html.style.backgroundImage = "url(/js/implementation/img/municipio_verde.jpg";
        this.html.className = "selectedMunicipality";
    } else {
//        this.html.style.backgroundImage = "url(/js/implementation/img/municipio_azul.jpg";
        this.html.className = "deselectedMunicipality";

    }
    return this;
};
Municipality.prototype.createHTML = function () {
    GenericObject.prototype.createHTML.call(this);
    this.info = document.createElement("div");
    this.info.innerHTML = "<b> nombre </b>: " + this.municipalityName + "<br />"
                        + "<b> categoría: </b>" + this.category + "<br />"
                        + "<b> código: </b>" + this.code + "<br />"
                        + "<b> departamento: </b>" + this.dept + "<br />";
    this.info.style.position = "absolute";
    this.info.style.display = "none"
    this.info.style.left = this.width + 2 +"px";
    this.info.style.top = this.height / 2 +"px";
    this.info.style.width = "200px";
    this.info.style.height = "80px";
    this.info.style.backgroundColor = "#737224";
    this.info.style.border = "thin black solid";
    this.info.style.zIndex = 10;

    this.html.appendChild(this.info);
    return this.html;

};
Municipality.prototype.attachListeners = function () {
    var $municipality = $(this.html);
    $municipality.on('mouseover', this.onMouseOver(this))
        .on('click', this.onClick(this))
        .on('mouseout', this.onMouseOut(this))
        .on('dblclick', this.onDblClick(this));
};

Municipality.prototype.onMouseOver = function (municipality) {
    return function (e, ui) {
        municipality.showInfo(true);
    }
};

Municipality.prototype.onDblClick = function (municipality) {
    return function (e, ui) {
        municipality.canvas.graphics[0].setToTendency(municipality);
    }
}
Municipality.prototype.onMouseOut = function (municipality) {
    return function (e, ui) {
        municipality.showInfo(false);
    };
};
Municipality.prototype.onClick = function (municipality) {
    return function (e, ui) {
        municipality.setSelected(true);
    }
};

Municipality.prototype.showInfo = function (show) {
    if (show) {
        this.info.style.display = "block";
    } else {
        this.info.style.display = "none";
    }
};

Municipality.prototype.setMunicipalityName = function (name) {
    this.municipalityName = name;
    return this;
};
Municipality.prototype.setCategory = function (category) {
    this.category = category;
    return this;
};
Municipality.prototype.setCode = function (code) {
    this.code = code;
    return this;
};
Municipality.prototype.setDept = function (dept) {
    this.dept = dept;
    return this;
};
Municipality.prototype.setX = function (newX) {
    this.x = newX - this.width / 2;
    return this;
};
Municipality.prototype.setY = function (newY) {
    this.y = newY - this.height / 2;
    return this;
};

Municipality.prototype.setSelected = function (selected) {
    var x = this.x + this.width / 2,
        y = this.y + this.height / 2;
    if (selected) {
        this.selected = true;
        this.deselectOthers(this.id);
        this.setDimension(20, 20);
        if(this.html)
        this.html.style.zIndex = 10;
    } else {
        this.selected = false;
        this.setDimension(14, 14);
        if (this.html)
        this.html.style.zIndex = 1;
    }
    this.setPosition(this.x, this.y);
    this.paint();
};

Municipality.prototype.deselectOthers = function (id) {
    var municipalities = this.canvas.municipalities,
        i,
        mun;

    for (i = 0; i < municipalities.length; i += 1) {
        mun = municipalities[i];
        if (mun.id !== id) {
            mun.setSelected(false);
        }
    }
    return this;

};