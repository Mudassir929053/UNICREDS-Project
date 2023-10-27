(function () {
	if ($('#userChart').length) {
		var options = {
			chart: {
				height: 60,
				type: 'area',
				toolbar: {
					show: false,
				},
				sparkline: {
					enabled: true,
				},
				grid: {
					show: false,
					padding: {
						left: 0,
						right: 0,
					},
				},
			},
			dataLabels: {
				enabled: false,
			},
			stroke: {
				curve: 'smooth',
				width: 2,
			},
			fill: {
				type: 'gradient',
				gradient: {
					shadeIntensity: 0.9,
					opacityFrom: 0.7,
					opacityTo: 0.5,
					stops: [0, 80, 100],
				},
			},
			series: [
				{
					name: 'User',
					data: [28, 40, 36, 52, 38, 60, 55],
				},
			],
			xaxis: {
				labels: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: [
				{
					y: 0,
					offsetX: 0,
					offsetY: 0,
					padding: {
						left: 0,
						right: 0,
					},
				},
			],
			tooltip: {
				x: {
					show: false,
				},
			},
		};

		var chart = new ApexCharts(document.querySelector('#userChart'), options);
		chart.render();
	}

	if ($('#userChartExample').length) {
		var options = {
			chart: {
				height: 60,
				type: 'area',
				toolbar: {
					show: false,
				},
				sparkline: {
					enabled: true,
				},
				grid: {
					show: false,
					padding: {
						left: 0,
						right: 0,
					},
				},
			},
			colors: ['#e53f3c'],
			dataLabels: {
				enabled: false,
			},
			stroke: {
				curve: 'smooth',
				width: 2,
			},
			fill: {
				type: 'gradient',
				gradient: {
					shadeIntensity: 0.9,
					opacityFrom: 0.7,
					opacityTo: 0.5,
					stops: [0, 80, 100],
				},
			},
			series: [
				{
					name: 'User',
					data: [28, 40, 36, 52, 38, 60, 55],
				},
			],
			xaxis: {
				labels: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: [
				{
					y: 0,
					offsetX: 0,
					offsetY: 0,
					padding: {
						left: 0,
						right: 0,
					},
				},
			],
			tooltip: {
				x: {
					show: false,
				},
			},
		};

		var chart = new ApexCharts(
			document.querySelector('#userChartExample'),
			options
		);
		chart.render();
	}

	// visitor chart

	if ($('#userChart').length) {
		var options = {
			chart: {
				height: 60,
				type: 'area',
				toolbar: {
					show: false,
				},
				sparkline: {
					enabled: true,
				},
				grid: {
					show: false,
					padding: {
						left: 0,
						right: 0,
					},
				},
			},
			colors: ['#19cb98'],
			dataLabels: {
				enabled: false,
			},
			stroke: {
				curve: 'smooth',
				width: 2,
			},
			fill: {
				colors: '#19cb98',
				type: 'gradient',
				gradient: {
					type: 'vertical',
					shadeIntensity: 0.9,
					opacityFrom: 0.7,
					opacityTo: 0.5,
					stops: [0, 100],
				},
			},
			series: [
				{
					name: 'User',
					data: [28, 40, 36, 52, 38, 60, 55],
				},
			],
			xaxis: {
				labels: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: [
				{
					y: 0,
					offsetX: 0,
					offsetY: 0,
					padding: {
						left: 0,
						right: 0,
					},
				},
			],
			tooltip: {
				x: {
					show: false,
				},
			},
		};

		var chart = new ApexCharts(
			document.querySelector('#visitorChart'),
			options
		);
		chart.render();
	}

	if ($('#bounceChart').length) {
		var options = {
			chart: {
				height: 60,
				type: 'line',
				toolbar: {
					show: false,
				},
				sparkline: {
					enabled: true,
				},
				grid: {
					show: false,
					padding: {
						left: 0,
						right: 0,
					},
				},
			},
			colors: ['#c28135'],
			dataLabels: {
				enabled: false,
			},
			stroke: {
				curve: 'straight',
				width: 4,
			},
			markers: {
				size: 4,
				hover: {
					size: 6,
					sizeOffset: 3,
				},
			},
			series: [
				{
					name: 'Bonus Rate',
					data: [28, 40, 36, 52, 38, 60, 55],
				},
			],
			xaxis: {
				labels: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: [
				{
					y: 0,
					offsetX: 0,
					offsetY: 0,
					padding: {
						left: 0,
						right: 0,
					},
				},
			],
			tooltip: {
				x: {
					show: false,
				},
			},
		};

		var chart = new ApexCharts(document.querySelector('#bounceChart'), options);
		chart.render();
	}

	if ($('#sessionChart').length) {
		var options = {
			series: [
				{
					name: 'Session Duration',
					data: [600, 1000, 400, 2000, 500, 900, 2500, 1800, 3800],
					colors: ['#754ffe'],
				},
				{
					name: 'Page Views',
					data: [1000, 2000, 800, 1200, 300, 1900, 1600, 2000, 1000],
				},
				{
					name: 'Total Visits',
					data: [2200, 1000, 3400, 900, 500, 2500, 3000, 1000, 2500],
				},
			],
			chart: {
				toolbar: {
					show: false,
				},
				height: 400,
				type: 'line',
				zoom: {
					enabled: false,
				},
			},
			dataLabels: {
				enabled: false,
			},
			stroke: {
				width: [4, 3, 3],
				curve: 'smooth',
				dashArray: [0, 5, 4],
			},

			legend: {
				show: false,
			},
			colors: ['#754ffe', '#19cb98', '#ffaa46'],
			markers: {
				size: 0,
				hover: {
					sizeOffset: 6,
				},
			},
			xaxis: {
				categories: [
					'01 Jan',
					'02 Jan',
					'03 Jan',
					'04 Jan',
					'05 Jan',
					'06 Jan',
					'07 Jan',
					'08 Jan',
					'09 Jan',
					'10 Jan',
					'11 Jan',
					'12 Jan',
				],
				labels: {
					style: {
						colors: ['#5c5776'],
						fontSize: '12px',
						fontFamily: 'Inter',

						cssClass: 'apexcharts-xaxis-label',
					},
				},
			},
			yaxis: {
				labels: {
					style: {
						colors: ['#5c5776'],
						fontSize: '12px',
						fontFamily: 'Inter',

						cssClass: 'apexcharts-xaxis-label',
					},
					offsetX: -12,
					offsetY: 0,
				},
			},
			tooltip: {
				y: [
					{
						title: {
							formatter: function (val) {
								return val + ' (mins)';
							},
						},
					},
					{
						title: {
							formatter: function (val) {
								return val + ' per session';
							},
						},
					},
					{
						title: {
							formatter: function (val) {
								return val;
							},
						},
					},
				],
			},

			grid: {
				borderColor: '#f1f1f1',
			},
		};

		var chart = new ApexCharts(
			document.querySelector('#sessionChart'),
			options
		);
		chart.render();
	}
	if ($('#support-chart1').length) {
		var options = {
			chart: {
				type: 'bar',
				height: 302,
				sparkline: {
					enabled: true,
				},
			},
			states: {
				normal: {
					filter: {
						type: 'none',
						value: 0,
					},
				},
				hover: {
					filter: {
						type: 'darken',
						value: 0.55,
					},
				},
				active: {
					allowMultipleDataPointsSelection: false,
					filter: {
						type: 'darken',
						value: 0.55,
					},
				},
			},
			colors: ['#8968fe'],
			plotOptions: {
				bar: {
					borderRadius: 4,
					columnWidth: '50%',
				},
			},
			series: [
				{
					data: [
						25,
						66,
						41,
						70,
						63,
						25,
						44,
						22,
						36,
						19,
						54,
						44,
						32,
						36,
						29,
						54,
						25,
						66,
						41,
						65,
						63,
						25,
						44,
						12,
						36,
						39,
						25,
						44,
						42,
						36,
						54,
					],
				},
			],
			xaxis: {
				crosshairs: {
					width: 1,
				},
			},
			tooltip: {
				fixed: {
					enabled: false,
				},
				x: {
					show: false,
				},
				y: {
					title: {
						formatter: function (seriesName) {
							return 'Active User';
						},
					},
				},
				marker: {
					show: false,
				},
			},
		};
		new ApexCharts(document.querySelector('#support-chart1'), options).render();
	}

	if ($('#locationmap').length) {
		const map = new jsVectorMap({
			map: 'world',
			selector: '#locationmap',
			zoomOnScroll: true,
			zoomButtons: true,
			markersSelectable: true,
			markers: [
				{ name: 'United Kingdom', coords: [53.613, -11.6368] },
				{ name: 'India', coords: [20.7504374, 73.7276105] },
				{ name: 'United States', coords: [37.2580397, -104.657039] },
				{ name: 'Australia', coords: [-25.0304388, 115.2092761] },
			],
			markerStyle: {
				initial: { fill: '#754FFE' },
			},
			markerLabelStyle: {
				initial: {
					fontFamily: 'Inter',
					fontSize: 13,
					fontWeight: 500,
					cursor: 'default',
					fill: '#18113C',
				},
			},
			labels: {
				markers: {
					render: (marker) => marker.name,
				},
			},
		});
	}

	if ($('#trafficDountChart').length) {
		var options = {
			series: [60, 55, 12, 17],
			labels: ['Organic Search', 'Direct', 'Refferrals', 'Social Media'],
			colors: ['#754FFE', '#19cb98', '#e53f3c', '#ffaa46'],
			chart: {
				type: 'donut',
				height: 260,
			},
			legend: {
				show: false,
			},
			dataLabels: {
				enabled: false,
			},
			plotOptions: {
				pie: {
					donut: {
						size: '50%',
					},
				},
			},
			stroke: {
				width: 2,
			},
		};

		var chart = new ApexCharts(
			document.querySelector('#trafficDountChart'),
			options
		);
		chart.render();
	}

	if ($('#operatingSystem').length) {
		var options = {
			series: [55, 88, 80, 75],
			labels: ['Window', 'macOS', 'Linux', 'Android'],
			chart: {
				type: 'polarArea',
				height: 350,
			},

			colors: ['#e53f3c', '#19cb98', '#754FFE', '#29BAF9'],
			legend: {
				show: false,
			},
			stroke: {
				colors: ['#fff'],
			},
			fill: {
				opacity: 0.9,
			},
		};

		var chart = new ApexCharts(
			document.querySelector('#operatingSystem'),
			options
		);
		chart.render();
	}
// expense chart
if ($('#expenseChart').length) {
	var options = {
		series: [9000, 4500, 9030, 6800, 2400, 8320],
		labels: [
			'Design',
			'Sass Service',
			'Development',
			'SEO',
			'Entertainment',
			'Marketing',
		],
		colors: [
			'#ffaa46',
			'#29BAF9',
			'#e53f3c',
			'#754FFE',
			'#29BAF9',
			'#19cb98',
		],
		chart: {
			type: 'donut',
			height: 450,
		},
		legend: {
			show: false,
		},
		dataLabels: {
			enabled: false,
		},
		plotOptions: {
			pie: {
				customScale: 0.8,
				startAngle: 55,
				endAngle: 360,
				expandOnClick: false,
				donut: {
					size: '70%',
					labels: {
						show: true,
						name: {
							show: true,
							offsetY: 26,
						},

						value: {
							show: true,
							fontSize: '42px',
							color: undefined,
							offsetY: -20,
							fontWeight: '700',
							formatter: function (val) {
								return '$' + val;
							},
						},
						total: {
							show: true,
							label: 'Total Spent',
							fontSize: '20px',
							color: '#beb9cd',
							fontWeight: '600',
							formatter: function (w) {
								return (
									'$' +
									w.globals.seriesTotals.reduce((a, b) => {
										return a + b;
									}, 0)
								);
							},
						},
					},
				},
			},
		},
		stroke: {
			width: 2,
		},
		responsive: [
			{
				breakpoint: 480,
				options: {
					chart: {
						type: 'donut',
						width: 290,
						height: 410,
					},
				},
			},
		],
	};
	var chart = new ApexCharts(
		document.querySelector('#expenseChart'),
		options
	);
	chart.render();
}

// task summary chart
if ($('#taskSummary').length) {
	var options = {
		series: [
			{
				name: 'Closed',
				type: 'column',
				data: [12, 18, 20, 32, 19, 25, 30],
			},
			{
				name: 'New',
				type: 'line',
				data: [20, 32, 28, 50, 38, 35, 49],
			},
		],
		chart: {
			height: 350,
			type: 'line',
			toolbar: {
				show: false,
			},
		},

		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '40%',
				borderRadius: 5,
			},
		},
		markers: {
			colors: [' #000000'],
			fillColor: '#f7f4f3',
		},
		colors: ['#e3dcff', '#754FFE'],
		legend: {
			show: false,
		},
		stroke: {
			width: [0, 4],
			colors: ['#e3dcff'],
		},
		dataLabels: {
			enabled: true,
			enabledOnSeries: [1],
		},

		labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
		xaxis: {
			labels: {
				style: {
					fontSize: '13px',
					fontWeight: 400,
					colors: '#a8a3b9',
					fontFamily: 'inter',
				},
			},
		},
		yaxis: {
			labels: {
				style: {
					fontSize: '13px',
					fontWeight: 400,
					colors: '#a8a3b9',
					fontFamily: 'inter',
				},
			},
		},
	};

	var chart = new ApexCharts(document.querySelector('#taskSummary'), options);
	chart.render();
}

// section chart
if ($('#taskSectionchart').length) {
	var options = {
		series: [44, 65, 89, 75],
		chart: {
			height: 400,
			type: 'radialBar',
		},
		legend: {
			show: true,
			fontSize: '14px',
			fontFamily: 'Inter',
			fontWeight: 500,
			position: 'bottom',
			itemMargin: {
				horizontal: 8,
				vertical: 0,
			},
			labels: {
				colors: '#5c5776',
				useSeriesColors: false,
			},
			markers: {
				width: 8,
				height: 8,
				offsetY: 1,
				offsetX: -2,
			},
		},
		plotOptions: {
			radialBar: {
				dataLabels: {
					name: {},
					value: {
						fontSize: '24px',
						fontWeight: 600,
						formatter: function (val) {
							return val;
						},
					},
					total: {
						show: true,
						label: 'Total',
						fontSize: '12px',
						formatter: function (w) {
							// By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
							return 273;
						},
					},
				},
				track: {
					background: '#f5f4f8',
					margin: 10,
				},
			},
		},
		labels: ['Design', 'Frontend', 'Development', 'Issues'],
		colors: ['#754FFE', '#19cb98', '#29BAF9', '#ffaa46'],
	};

	var chart = new ApexCharts(
		document.querySelector('#taskSectionchart'),
		options
	);
	chart.render();
}

// budget Expense chart
if ($('#budgetExpenseChart').length) {
	var options = {
		series: [
			{
				name: 'Series 1',
				data: [90, 32, 30, 40, 100, 20],
			},
		],
		dataLabels: {
			enabled: true,
			background: {
				enabled: true,
				borderRadius: 2,
			},
		},
		chart: {
			height: 350,
			type: 'radar',
			toolbar: {
				show: false,
			},
		},
		colors: ['#754FFE'],
		plotOptions: {
			radar: {
				size: 150,
				offsetX: 0,
				offsetY: 0,
				polygons: {
					strokeColors: '#eae7f5',
					strokeWidth: 1,
					connectorColors: '#eae7f5',
					fill: {
						colors: undefined,
					},
				},
			},
		},

		xaxis: {
			categories: [
				'Design',
				'SaaS Services',
				'Development',
				'SEO',
				'Entertainment',
				'Marketing',
			],

			labels: {
				show: true,



				style: {
					colors: [
						'#5c5776',
						'#5c5776',
						'#5c5776',
						'#5c5776',
						'#5c5776',
						'#5c5776',
					],
					fontSize: '14px',
					fontFamily: 'Inter',
					fontWeight: 600,
				},
			},
		},
	};

	var chart = new ApexCharts(
		document.querySelector('#budgetExpenseChart'),
		options
	);
	chart.render();
}

// task Wireframe chart
if ($('.taskWireframeChart').length) {
	var options = {
		series: [65],
		chart: {
			height: 40,
			width: 40,
			type: 'radialBar',
		},
		grid: {
			show: false,
			padding: {
				left: -15,
				right: -15,
				top: -12,
				bottom: -15,
			},
		},
		colors: ['#19cb98'],
		plotOptions: {
			radialBar: {
				hollow: {
					size: '30%',
				},

				dataLabels: {
					showOn: 'always',
					name: {
						show: true,
						fontSize: '11px',
						fontFamily: undefined,
						fontWeight: 600,
						color: undefined,
						offsetY: 4,
					},
					value: {
						show: false,
					},
				},
			},
		},
		stroke: {
			lineCap: 'round',
		},
		labels: ['65%'],
	};
	var chart = new ApexCharts(
		document.querySelector('.taskWireframeChart'),
		options
	);
	chart.render();
}



// prototype chart
if ($('.taskPrototypeChart').length) {
	var options = {
		series: [75],
		chart: {
			height: 40,
			width: 40,
			type: 'radialBar',
		},
		grid: {
			show: false,
			padding: {
				left: -15,
				right: -15,
				top: -12,
				bottom: -15,
			},
		},
		colors: ['#19cb98'],
		plotOptions: {
			radialBar: {
				hollow: {
					size: '30%',
				},

				dataLabels: {
					showOn: 'always',
					name: {
						show: true,
						fontSize: '11px',
						fontFamily: undefined,
						fontWeight: 600,
						color: undefined,
						offsetY: 4,
					},
					value: {
						show: false,
					},
				},
			},
		},
		stroke: {
			lineCap: 'round',
		},
		labels: ['75%'],
	};
	var chart = new ApexCharts(
		document.querySelector('.taskPrototypeChart'),
		options
	);
	chart.render();
}



// task Content chart
if ($('.taskContentChart').length) {
	var options = {
		series: [85],
		chart: {
			height: 40,
			width: 40,
			type: 'radialBar',
		},
		grid: {
			show: false,
			padding: {
				left: -15,
				right: -15,
				top: -12,
				bottom: -15,
			},
		},
		colors: ['#19cb98'],
		plotOptions: {
			radialBar: {
				hollow: {
					size: '30%',
				},

				dataLabels: {
					showOn: 'always',
					name: {
						show: true,
						fontSize: '11px',
						fontFamily: undefined,
						fontWeight: 600,
						color: undefined,
						offsetY: 4,
					},
					value: {
						show: false,
					},
				},
			},
		},
		stroke: {
			lineCap: 'round',
		},
		labels: ['85%'],
	};
	var chart = new ApexCharts(
		document.querySelector('.taskContentChart'),
		options
	);
	chart.render();
}



// task Figma chart
if ($('.taskFigmaChart').length) {
	var options = {
		series: [40],
		chart: {
			height: 40,
			width: 40,
			type: 'radialBar',
		},
		grid: {
			show: false,
			padding: {
				left: -15,
				right: -15,
				top: -12,
				bottom: -15,
			},
		},
		colors: ['#19cb98'],
		plotOptions: {
			radialBar: {
				hollow: {
					size: '30%',
				},

				dataLabels: {
					showOn: 'always',
					name: {
						show: true,
						fontSize: '11px',
						fontFamily: undefined,
						fontWeight: 600,
						color: undefined,
						offsetY: 4,
					},
					value: {
						show: false,
					},
				},
			},
		},
		stroke: {
			lineCap: 'round',
		},
		labels: ['40%'],
	};
	var chart = new ApexCharts(
		document.querySelector('.taskFigmaChart'),
		options
	);
	chart.render();
}




// task Interface chart
if ($('.taskInterfaceChart').length) {
	var options = {
		series: [35],
		chart: {
			height: 40,
			width: 40,
			type: 'radialBar',
		},
		grid: {
			show: false,
			padding: {
				left: -15,
				right: -15,
				top: -12,
				bottom: -15,
			},
		},
		colors: ['#19cb98'],
		plotOptions: {
			radialBar: {
				hollow: {
					size: '30%',
				},

				dataLabels: {
					showOn: 'always',
					name: {
						show: true,
						fontSize: '11px',
						fontFamily: undefined,
						fontWeight: 600,
						color: undefined,
						offsetY: 4,
					},
					value: {
						show: false,
					},
				},
			},
		},
		stroke: {
			lineCap: 'round',
		},
		labels: ['35%'],
	};
	var chart = new ApexCharts(
		document.querySelector('.taskInterfaceChart'),
		options
	);
	chart.render();
}



// task status chart
if ($('#taskStatus').length) {
	var options = {
		dataLabels: {
			enabled: false,
		},
		series: [75, 25],
		labels: ['Completed', 'Incomplete'],
		colors: ['#754FFE', '#29BAF9'],
		chart: {
			width: 480,
			type: 'donut',
		},
		plotOptions: {
			pie: {
				expandOnClick: false,
				donut: {
					size: '75%',
				},
			},
		},
		legend: {
			position: 'bottom',
			fontFamily: 'inter',
			fontWeight: 500,
			fontSize: '14px',
			markers: {
				width: 8,
				height: 8,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,
				customHTML: undefined,
				onClick: undefined,
				offsetX: -2,
				offsetY: 1,
			},
			itemMargin: {
				horizontal: 8,
				vertical: 0,
			},
		},
		tooltip: {
			theme: 'light',
			marker: {
				show: true,
			},
			x: {
				show: false,
			},
		},
		states: {
			hover: {
				filter: {
					type: 'none',
				},
			},
		},
		responsive: [
			{
				breakpoint: 1400,
				options: {
					chart: {
						type: 'donut',
						width: 290,
						height: 410,
					},
				},
			},
		],
	};

	var chart = new ApexCharts(document.querySelector('#taskStatus'), options);
	chart.render();
}



// progress chart
if ($('#progressChart').length) {
	var options = {
		series: [75],
		chart: {
			height: 350,
			type: 'radialBar',
			toolbar: {
				show: false,
			},
		},
		colors: ['#754FFE', '#ffaa46'],
		plotOptions: {
			radialBar: {
				startAngle: -135,
				endAngle: 225,
				hollow: {
					margin: 0,
					size: '70%',
					background: '#fff',
					image: undefined,
					imageOffsetX: 0,
					imageOffsetY: 0,
					position: 'front',
					dropShadow: {
						enabled: true,
						top: 3,
						left: 0,
						blur: 4,
						opacity: 0.24,
					},
				},
				track: {
					background: '#fff',
					strokeWidth: '67%',
					margin: 0, // margin is in pixels
					dropShadow: {
						enabled: true,
						top: -3,
						left: 0,
						blur: 4,
						opacity: 0.35,
					},
				},

				dataLabels: {
					showOn: 'always',

					name: {
						show: false,
					},
					value: {
						formatter: function (val) {
							return parseInt(val) + '%';
						},
						color: '#18113C',
						fontSize: '48px',
						fontWeight: '700',
						show: true,
					},
				},
			},
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'dark',
				type: 'horizontal',
				shadeIntensity: 0.5,
				gradientToColors: ['#ffaa46'],
				inverseColors: false,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 100],
			},
		},
		stroke: {
			lineCap: 'round',
		},
	};

	var chart = new ApexCharts(
		document.querySelector('#progressChart'),
		options
	);
	chart.render();
}
})();
