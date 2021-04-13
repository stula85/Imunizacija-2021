const data = {
	"tblosnovna_bd" : {
		"naziv" : "Osnovna",
		"kolone" : [
		{ kolona: "osnovna.*", naziv: "Sve", tip: "S"},
		{ kolona: "osnovna.naziv_subjekta", naziv: "Naziv subjekta", tip: "S"},
		{ kolona: "osnovna.sjediste", naziv: "Sjedište", tip: "S"},
		{ kolona: "osnovna.zip", naziv: "ZIP", tip: "N"},
		{ kolona: "osnovna.ulica", naziv: "Ulica", tip: "S"},
		{ kolona: "osnovna.telefon", naziv: "Telefon", tip: "S"},
		{ kolona: "osnovna.email", naziv: "Email", tip: "S"},
		{ kolona: "osnovna.internet_adresa", naziv: "Internet adresa", tip: "S"},
		{ kolona: "osnovna.jurisdikcija", naziv: "Jurisdikcija", tip: "S"},
		{ kolona: "osnovna.fax", naziv: "Fax", tip: "S"},
		{ kolona: "osnovna.vrsta", naziv: "Vrsta", tip: "S"},
		{ kolona: "osnovna.osnivacki_akt", naziv: "Osnivački akt", tip: "S"},
		{ kolona: "osnovna.glasilo", naziv: "Glasilo", tip: "S"},
		{ kolona: "osnovna.rukovodilac", naziv: "Rukovodilac",  tip: "S"},
		{ kolona: "osnovna.imenovanje", naziv: "Imenovanje", tip: "S"},
		{ kolona: "osnovna.odgovornost", naziv: "Odgovornost", tip: "S"},
		{ kolona: "osnovna.unutrasnje_uredjenje", naziv: "Unutrašnje uređenje", tip: "S"}
		]
	},
	"tblosnovdjelokruga_bd": {
		"naziv" : "Osnov djelokruga",
		"kolone": [
			{ kolona: "osnov_djelokruga.*", naziv: "Sve", tip: "S"},
			{ kolona: "osnov_djelokruga.akt", naziv: "Akt", tip: "S"},
			{ kolona: "osnov_djelokruga.glasilo", naziv: "Glasilo", tip: "S"}
		],
	},
	"tbldjelokrug_bd": {
		"naziv" : "Djelokrug",
		"kolone": [
			{ kolona: "djelokrug.*", naziv: "Sve", tip: "S"},
			{ kolona: "djelokrug.clan", naziv: "Član", tip: "S"},
			{ kolona: "djelokrug.duznost", naziv: "Dužnost", tip: "S"},
			{ kolona: "djelokrug.poglavlje", naziv: "Poglavlje", tip: "S"},
			{ kolona: "djelokrug.sektor", naziv: "Sektor", tip: "S"}
		]
	},
	"tblnadzor_bd": {
		"naziv" : "Nadzor",
		"kolone": [
			{ kolona: "nadzor.*", naziv: "Sve", tip: "S"},
			{ kolona: "nadzor.akt", naziv: "Akt", tip: "S"},
			{ kolona: "nadzor.glasilo", naziv: "Glasilo", tip: "S"},
			{ kolona: "nadzor.napomena", naziv: "Napomena", tip: "S"},
			{ kolona: "nadzor.osnov_za_nadzor", naziv: "Osnov za nadzor", tip: "S"}
		]
	}
};

const vrste_poredjenja = {
	"N": [
		["-1", "Odaberite uslov"],
		["=", "="],
		[">", ">"],
		[">=", ">="],
		["<", "<"],
		["<=", "<="],
		["!=", "!="]
	],
	"S": [
		["-1", "Odaberite uslov"],
		["=", "="],
		["!=", "!="],
		["LIKE", "LIKE"],
		["NOT LIKE", "NOT LIKE"],
		["IS NULL", "IS NULL"],
		["IS EMPTY", "IS EMPTY"],
		["IS NOT NULL", "IS NOT NULL"],
	]
};

let selectSQL = "";
let whereSQL = " 1 = 1 ";

const modal = $("#queryBuilderModal");
const modalBody = $("#queryBuilderBody");

$(function(){
	$("#queryBuilder").on("click", function(e){
		e.preventDefault();
		modal.modal("show");
		modalBody.html("");
		dodajRed();
	});

	$("#prikaziRezultate").on("click", function(){
		generisiSQL();
	});

	$("#queryBuilderExport").on("click", function(){
		window.location.href = window.location.href.replace("/bd/qb", `/bd/export?selectSQL=${selectSQL}&whereSQL=${whereSQL}`); 
	});
});

function obrisiStavku(rowID){
	$(`#${rowID}`).remove();
}

function dodajRed(){
	const rowID = Date.now();

	const red = formirajRed(rowID);

	const html = `
		<div class="row" id="${rowID}">
      		${red.tabela}

      		${red.kolona}

      		${red.vrste_poredjenja}

      		${red.vrijednost}

      		<div class="form-group col-md-1">
      			<label>&nbsp;</label><br/>
      			<button class="btn btn-danger" onclick="obrisiStavku(${rowID})">X</button>
      		</div>
      	</div>	      
	`;

	modalBody.append(html);
}

function formirajRed(rowID){
	let lcbTabela = `<div class="form-group col-md-3"><label>Tabela</label><select id="lcb${rowID}1" name="lcb${rowID}1" class="form-control" onchange="azurirajKolone(${rowID})">`;

 	Object.keys(data).forEach(key => {
 		lcbTabela += `<option value='${key}'>${data[key].naziv}</option>`;
 	});

    lcbTabela += `</select></div>`;

    let lcbKolona = `
    	<div class="form-group col-md-3">
    		<label>Kolona</label>
    		<select id="lcb${rowID}2" name="lcb${rowID}2" class="form-control" onchange="azurirajVrste(${rowID})">`;

    data[Object.keys(data)[0]].kolone.forEach(kolona => {
    	lcbKolona += `<option value="${kolona.kolona}" data-tip="${kolona.tip}">${kolona.naziv}</option>`
    });
    lcbKolona += `</select></div>`;

    const lcbVrsta = `
    	<div class="form-group col-md-2">
    		<label>Uslov</label>
    		<select id="lcb${rowID}3" name="lcb${rowID}3" class="form-control"></select>
		</div>
	`;

    const vrijednost = `
    	<div class="form-group col-md-3">
    		<label>Vrijednost</label>
    		<input id="edt${rowID}4" name="edt${rowID}4" class="form-control">
    	</div> 
    `;

    return {
    	tabela: lcbTabela,
    	kolona: lcbKolona,
    	vrste_poredjenja: lcbVrsta,
    	vrijednost
    }
}

function azurirajKolone(rowID){
	const tabela = $(`#lcb${rowID}1`).val();

	let lcbKolona = '';

    data[tabela].kolone.forEach(kolona => {
    	lcbKolona += `<option value="${kolona.kolona}" data-tip="${kolona.tip}">${kolona.naziv}</option>`;
    });

    $(`#lcb${rowID}2`).html("");
    $(`#lcb${rowID}2`).append(lcbKolona);
}

function azurirajVrste(rowID){
	const tip = $(`#lcb${rowID}2 option:selected`).data("tip");

	let lcbKolona = '';

	vrste_poredjenja[tip].forEach(item => {
    	lcbKolona += `<option value="${item[0]}">${item[1]}</option>`;
    });

    $(`#lcb${rowID}3`).html("");
    $(`#lcb${rowID}3`).append(lcbKolona);
}

function generisiSQL(){
	selectSQL = "";
	whereSQL = " 1 = 1 ";

	$("#queryBuilderBody .row").each((index, row) => {
		const red = $(row);
		const rowID = red.attr("id");
		const kolona = $(`#lcb${rowID}2`).val();
		const tabela = $(`#lcb${rowID}1`).val();

		if(kolona.indexOf(".*") === -1){
			selectSQL += `${kolona},`;
			const vrijednost = $(`#edt${rowID}4`).val();
			const vrsta = $(`#lcb${rowID}3`).val();

			if(parseInt(vrsta) !== -1){
				if(vrsta === "IS NULL"){
					whereSQL += ` AND ${kolona} IS NULL `;
				}else if(vrsta === "IS NOT NULL"){
					whereSQL += ` AND ${kolona} IS NOT NULL `;
				}else if(vrsta === "IS EMPTY"){
					whereSQL += ` AND ${kolona} = '' `;
				}else if(vrsta.indexOf("LIKE") === -1){
					whereSQL += ` AND ${kolona} ${vrsta} '${vrijednost}' `;
				}else{
					whereSQL += ` AND ${kolona} ${vrsta} '%${vrijednost}%' `;
				}
			}
		}else{
			data[tabela].kolone.forEach(row => {
				if(row.naziv !== "Sve"){
					selectSQL += `${row.kolona},`;
				}
			});
		}
	});

	selectSQL = rtrim(selectSQL, ",");
	const url = window.location.href.replace("/bd/qb", "/bd/qb_ajax"); 

	$.ajax({
		url: url,
		method: "POST",
		dataType:"json",
		data: {
			selectSQL,
			whereSQL
		},
		success: function(response){
			modal.modal("hide");
			let zaglavlje = `<tr>`;

			for(const key of Object.keys(response[0])){
				zaglavlje += `<th>${key}</th>`;
			}
			
			zaglavlje += `</tr>`;

			$("#tblResultHeader").html(zaglavlje);

			let redovi = "";
			response.forEach(row => {
				redovi += `<tr>`;
				for(const key of Object.keys(response[0])){
					redovi += `<td>${row[key]}</td>`;
				}
				redovi += `</tr>`;
			});

			$("#tblResultBody").html(redovi);
		}
	});
}

function rtrim(str, chr){
	const rgxTrim = (!chr) ? new RegExp("\\s+$") : new RegExp(chr + "+$");
	return str.replace(rgxTrim, "");
}