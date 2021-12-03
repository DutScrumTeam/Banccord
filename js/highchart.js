const monthsFull = [
	"Janvier",
	"Février",
	"Mars",
	"Avril",
	"Mai",
	"Juin",
	"Juillet",
	"Août",
	"Septembre",
	"Octobre",
	"Novembre",
	"Decembre"
];
/**
 * Créer le graph highchart avec comme paramètre un JSON.
 * @param {array} lines
 * @param {Date} dateStart
 * @param {Date} dateEnd
 */
function createPaymentChart(lines, dateStart, dateEnd) {
	// Numéro de la colonne contenant la date.
	const numDate = 1;
	// Numéro de la colonne contenant le montant.
	const numAmount = 5;

	// Création du tableau des résultats.
	let results = new Map();
	for (
		let i = dateStart.getFullYear()*12+dateStart.getMonth();
		i <= dateEnd.getFullYear()*12+dateEnd.getMonth();
		i++)
	{
		const keyDate = new Date(Math.trunc(i/12), i%12);
		results.set(dateToMonthString(keyDate), 0);
	}
	
	// Ajout des éléments dans le tableau des résultats.
	lines.forEach(elem => {
		const d = sqlDateToJsDate(elem.children[numDate].innerHTML);
		if (d.getTime() >= dateStart && d.getTime() <= dateEnd) {
			// Ajout de l'elem aux resultats
			const amount = Number(elem.children[numAmount].innerHTML.replace(/€/g, ""));
			for ( // Pour chaque date après la date de remise, on ajoute le montant.
				let i=d.getFullYear()*12+d.getMonth();
				i <= dateEnd.getFullYear()*12+dateEnd.getMonth();
				i++)
			{
				const key = dateToMonthString(new Date(Math.trunc(i/12), i%12));
				results.set(key, results.get(key) + amount);
			}
		}
	});

	// Mise en forme des données pour l'ajout dans le graphique.
	let data = [];
	for (const entry of results.entries()) {
		data.push(entry);
	}	

	Highcharts.chart('container', {
		title: {
			text: `Evolution de la trésorerie entre ${dateToMonthString(dateStart)} et ${dateToMonthString(dateEnd)}`
		},
		subtitle: {
			text: 'Source: thesolarfoundation.com'
		},
		yAxis: {
			title: {
				text: 'Montant de la trésorerie (€)'
			}
		},
		xAxis: {
			title: {
				text: 'Mois'
			},
			accessibility: {
				rangeDescription: 'Range: 2010 to 2017'
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 1
			}
		},
		series: [{
			name: 'Trésorerie',
			data: data
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
}

/**
 * Initialise le camembert des impayés.
 * @param {array} lines 
 */
function createPieUnpaid(lines) {
	const idLib = 3;
	let res = {
		"fraude à la carte": 0,
		"compte à découvert": 0,
		"compte clôturé": 0,
		"compte bloqué": 0,
		"provision insuffisante": 0,
		"opération contesté par le débiteur": 0,
		"titulaire décédé": 0,
		"raison non communiquée": 0
	}
	const total = lines.length;

	// Récupération de la data.
	lines.forEach(elem => {
		res[elem.children[idLib].innerHTML] += 1;
	});

	let data = [];
	Object.keys(res).forEach(key => {
		if (res[key] !== 0) {
			data.push({
				name: key,
				y: res[key] / total * 100
			})
		}
	})

	// Creation du graphique.
	Highcharts.chart('pie-chart', {
		chart: {
			type: 'pie'
		},
		title: {
			text: 'Raisons des impayés'
		},
		subtitle: {
			text: 'Les raisons des impayés et leurs ratios par rapport aux autres impayés.'
		},
		accessibility: {
			announceNewData: {
				enabled: true
			},
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true,
					format: '{point.name}: {point.y:.1f}%'
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},
		series: [
			{
				name: "Impayés",
				colorByPoint: true,
				data: data
			}
		]
	});
}

/**
 * Traduit une date par une écriture simplifié courte
 * ex : Janvier 2021
 * @param {Date} date 
 */
function dateToMonthString(date) {
	return `${monthsFull[date.getMonth()]} ${date.getFullYear()}`;
}

/**
 * Transform une date au format yyyy-mm-dd
 * en un object Date de JS.
 * @param {string} date 
 */
function sqlDateToJsDate(date) {
	const splited = date.split(/-/g);
	return new Date(`${splited[1]}/${splited[2]}/${splited[0]}`);
}

/**
 * Initialise l'histogramme des impayés par date
 * @param {array} lines
 * @param {Date} dateStart
 * @param {Date} dateEnd
 */
function createColumnUnpaid(lines, dateStart, dateEnd) {
	// Numéro de la colonne contenant la date.
	const numDate = 1;
	// Numéro de la colonne contenant le montant.
	const numAmount = 4;

	// Création du tableau des résultats.
	let results = new Map();
	for (
		let i = dateStart.getFullYear()*12+dateStart.getMonth();
		i <= dateEnd.getFullYear()*12+dateEnd.getMonth();
		i++)
	{
		const keyDate = new Date(Math.trunc(i/12), i%12);
		results.set(dateToMonthString(keyDate), 0);
	}
	
	// Ajout des éléments dans le tableau des résultats.
	lines.forEach(elem => {
		const d = sqlDateToJsDate(elem.children[numDate].innerHTML);
		if (d.getTime() >= dateStart && d.getTime() <= dateEnd) {
			// Ajout de l'elem aux resultats
			const amount = Number(elem.children[numAmount].innerHTML.replace(/€/g, ""));
			const key = dateToMonthString(d);
			results.set(key, results.get(key) - amount);
		}
	});

	// Mise en forme des données pour l'ajout dans le graphique.
	let data = [];
	for (const entry of results.entries()) {
		data.push(entry);
	}

	// Création du graphique
	Highcharts.chart('column-chart', {
		chart: {
			type: 'column'
		},
		title: {
			text: `Impayés entre ${dateToMonthString(dateStart)} et ${dateToMonthString(dateEnd)}`
		},
		// subtitle: {
		// 	text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
		// },
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Impayés (€)'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Impayés : {point.y:.2f}€</b>'
		},
		series: [{
			name: 'Impayés',
			data: data,
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				format: '{point.y:.1f}', // one decimal
				y: 10, // 10 pixels down from the top
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
}