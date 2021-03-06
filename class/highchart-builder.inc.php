<?php
if (!defined("DEF_HIGHCHART_BUILDER")) {
define("DEF_HIGHCHART_BUILDER", true);

function echoPaymentChart() {
	echo '
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		
		<figure class="highcharts-figure">
			<div id="container"></div>
			<!-- <p class="highcharts-description">
				Basic line chart showing trends in a dataset. This chart includes the
				<code>series-label</code> module, which adds a label to each line for
				enhanced readability.
			</p> -->
		</figure>
	';
}

function echoPieUnpaid() {
	echo '
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/drilldown.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		
		<figure class="highcharts-figure">
			<div id="pie-chart"></div>
			<!-- <p class="highcharts-description">
				Pie chart where the individual slices can be clicked to expose more
				detailed data.
			</p> -->
		</figure>
	';
}

function echoColumnUnpaid() {
	echo '
		<!--
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		-->
		
		<figure class="highcharts-figure">
			<div id="column-chart"></div>
			<!-- <p class="highcharts-description">
				Chart showing use of rotated axis labels and data labels. This can be a
				way to include more labels in the chart, but note that more labels can
				sometimes make charts harder to read.
			</p> -->
		</figure>
	';
}

}