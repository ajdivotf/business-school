function d3_pie(data, div_id) {
	const names = data.map(d => d.name);
	const values = data.map(d => d.value);
	const text = '';
	const width = 260;
	const height = 260;
	const thickness = 40;
	const duration = 750;
	const radius = Math.min(width, height) / 2;
	const color = d3.scaleLinear().domain([0, 100]).range(['white', 'rgb(143, 65, 245)']);
	const svg = d3.select(div_id)
		.append('svg')
		.attr('class', 'pie')
		.attr('width', width + 220)
		.attr('height', height);
	const size = 15
	svg.selectAll('mydots')
		.data(values)
		.enter()
		.append('rect')
		.attr('x', width + 50)
		.attr('y', function (d, i) { return 100 + i * (size + 6) }) // 100 is where the first dot appears. 25 is the distance between dots
		.attr('width', size)
		.attr('height', size)
		.style('fill', function (d) { return color(d) })
	svg.selectAll('mylabels')
		.data(names)
		.enter()
		.append('text')
		.attr('x', width + 55 + size * 1.2)
		.attr('y', function (d, i) { return 100 + i * (size + 6.5) + (size / 2) }) // 100 is where the first dot appears. 25 is the distance between dots
		.style('fill', 'black')
		.style('font-size', '14px')
		.text(function (d) { return d })
		.attr('text-anchor', 'left')
		.style('alignment-baseline', 'middle')
	const g = svg.append('g')
		.attr('transform', 'translate(' + (width / 2) + ',' + (height / 2) + ')');
	const arc = d3.arc()
		.innerRadius(radius - thickness)
		.outerRadius(radius);
	const pie = d3.pie()
		.value(function (d) { return d.value; })
		.sort(null);
	const path = g.selectAll('path')
		.data(pie(data))
		.enter()
		.append('g')
		.on('mouseover', function (d) {
			let g = d3.select(this)
				.style('cursor', 'pointer')
				.style('fill', 'black')
				.append('g')
				.attr('class', 'text-group');

			g.append('text')
				.attr('class', 'name-text')
				.text(d.data.name)
				.attr('text-anchor', 'middle')
				.attr('dy', '-1.2em');

			g.append('text')
				.attr('class', 'value-text')
				.text(d3.format('.2f')(d.data.value) + '%')
				.attr('text-anchor', 'middle')
				.attr('dy', '.6em');
		})
		.on('mouseout', function (d) {
			d3.select(this)
				.style('cursor', 'none')
				.style('fill', color(this._current))
				.select('.text-group').remove();
		})
		.append('path')
		.attr('d', arc)
		.attr('fill', (d, i) => color(d.value))
		.attr('stroke', 'white')
		.style('stroke-width', '1px')
		.on('mouseover', function (d) {
			d3.select(this)
				.style('cursor', 'pointer')
				.style('fill', 'rgb(236, 239, 255)');
		})
		.on('mouseout', function (d) {
			d3.select(this)
				.style('cursor', 'none')
				.style('fill', color(this._current));
		})
		.each(function (d, i) { this._current = d.value; });
	g.append('text')
		.attr('text-anchor', 'middle')
		.attr('dy', '.35em')
		.text(text);
};
