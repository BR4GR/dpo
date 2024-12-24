import * as d3 from "d3";

export default class STD {


    static applies() {
        return $('#inverkehrsetzungen').length > 0;
    }


    constructor() {
        this.renderLineChart();
        this.renderStackedBarChart();
    }


    getInverkehrsetzungen() {
        return [
            { year: 2005, Benzin: 185120, Diesel: 74114, Hybrid: 604, Elektrisch: 13, Wasserstoff: 0, Gas: 442, Andere: 389 },
            { year: 2006, Benzin: 185807, Diesel: 80857, Hybrid: 1569, Elektrisch: 9, Wasserstoff: 0, Gas: 1064, Andere: 441 },
            { year: 2007, Benzin: 185055, Diesel: 92333, Hybrid: 3219, Elektrisch: 19, Wasserstoff: 0, Gas: 1653, Andere: 1692 },
            { year: 2008, Benzin: 189151, Diesel: 93366, Hybrid: 3064, Elektrisch: 24, Wasserstoff: 0, Gas: 1136, Andere: 1201 },
            { year: 2009, Benzin: 182174, Diesel: 78755, Hybrid: 3875, Elektrisch: 57, Wasserstoff: 0, Gas: 1063, Andere: 529 },
            { year: 2010, Benzin: 200576, Diesel: 90547, Hybrid: 4213, Elektrisch: 201, Wasserstoff: 0, Gas: 721, Andere: 302 },
            { year: 2011, Benzin: 211540, Diesel: 109324, Hybrid: 5325, Elektrisch: 452, Wasserstoff: 0, Gas: 651, Andere: 526 },
            { year: 2012, Benzin: 200576, Diesel: 124911, Hybrid: 5530, Elektrisch: 924, Wasserstoff: 1, Gas: 519, Andere: 406 },
            { year: 2013, Benzin: 185070, Diesel: 115656, Hybrid: 5966, Elektrisch: 1392, Wasserstoff: 0, Gas: 791, Andere: 87 },
            { year: 2014, Benzin: 180875, Diesel: 113304, Hybrid: 5569, Elektrisch: 1948, Wasserstoff: 0, Gas: 1041, Andere: 22 },
            { year: 2015, Benzin: 185469, Diesel: 127899, Hybrid: 5458, Elektrisch: 3882, Wasserstoff: 15, Gas: 1080, Andere: 13 },
            { year: 2016, Benzin: 178666, Diesel: 125595, Hybrid: 7150, Elektrisch: 3525, Wasserstoff: 10, Gas: 944, Andere: 4 },
            { year: 2017, Benzin: 183637, Diesel: 113848, Hybrid: 8186, Elektrisch: 4929, Wasserstoff: 2, Gas: 769, Andere: 1 },
            { year: 2018, Benzin: 188847, Diesel: 90360, Hybrid: 10434, Elektrisch: 5411, Wasserstoff: 27, Gas: 805, Andere: 5 },
            { year: 2019, Benzin: 192430, Diesel: 79618, Hybrid: 18133, Elektrisch: 13197, Wasserstoff: 27, Gas: 1252, Andere: 2 },
            { year: 2020, Benzin: 119097, Diesel: 51987, Hybrid: 27423, Elektrisch: 19765, Wasserstoff: 48, Gas: 571, Andere: 0 },
        ];
    }

    getConsolidatedData = () => {
        const rawData = this.getInverkehrsetzungen();

        const consolidated = rawData.map(d => ({
            year: d.year,
            Konventionelle: d.Benzin + d.Diesel,
            Alternative: d.Hybrid + d.Elektrisch,
            Andere: d.Wasserstoff + d.Gas + d.Andere,
            Total: d.Benzin + d.Diesel + d.Hybrid + d.Elektrisch + d.Wasserstoff + d.Gas + d.Andere,
        }));
        return consolidated;
    };



    renderLineChart() {
        const data = this.getInverkehrsetzungen();
        const keys = ["Benzin", "Diesel", "Hybrid", "Elektrisch", "Wasserstoff", "Gas", "Andere"];
        const colors = d3.schemeCategory10;

        const margin = { top: 50, right: 20, bottom: 50, left: 70 };
        const width = 900 - margin.left - margin.right;
        const height = 600 - margin.top - margin.bottom;

        // Create SVG container
        const svg = d3.select("#inverkehrsetzungen")
            .append("svg")
            .attr("width", "100%")
            .attr("viewBox", `0 0 ${width + margin.left + margin.right} ${height + margin.top + margin.bottom}`)
            .attr("preserveAspectRatio", "xMinYMin meet");

        const chart = svg.append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        // Scales
        const x = d3.scaleLinear()
            .domain(d3.extent(data, d => d.year))
            .range([0, width]);

        const y = d3.scaleLinear()
            .domain([0, d3.max(data, d => d3.max(keys, key => d[key])) / 1000]) // Values divided by 1000
            .range([height, 0]);

        const color = d3.scaleOrdinal().domain(keys).range(colors);

        // Axes
        const xAxis = d3.axisBottom(x).ticks(5).tickFormat(d3.format("d"));
        const yAxis = d3.axisLeft(y).ticks(5).tickFormat(d => `${d}k`);

        chart.append("g")
            .attr("transform", `translate(0,${height})`)
            .call(xAxis)
            .selectAll("text")
            .style("font-size", "17px");

        chart.append("g")
            .call(yAxis)
            .selectAll("text")
            .style("font-size", "17px");

        // Title
        svg.append("text")
            .attr("x", (width + margin.left + margin.right) / 2)
            .attr("y", margin.top / 2)
            .attr("text-anchor", "middle")
            .style("font-size", "18px")
            .style("fill", "#fff")
            .text("Neue Inverkehrsetzungen von Personenwagen nach Treibstoff (2005–2020)");

        // Y-axis label
        chart.append("text")
            .attr("x", -height / 2)
            .attr("y", -margin.left + 20)
            .attr("transform", "rotate(-90)")
            .attr("text-anchor", "middle")
            .style("font-size", "17px")
            .style("fill", "#fff")
            .text("Anzahl in Tausend");

        // X-axis label
        chart.append("text")
            .attr("x", width / 2)
            .attr("y", height + margin.bottom - 10)
            .attr("text-anchor", "middle")
            .style("font-size", "17px")
            .style("fill", "#fff")
            .text("Jahr");

        // Tooltip
        const tooltip = d3.select("body")
            .append("div")
            .style("position", "absolute")
            .style("padding", "10px")
            .style("background", "rgba(0, 0, 0, 0.8)")
            .style("color", "#fff")
            .style("border-radius", "5px")
            .style("display", "none")
            .style("pointer-events", "none");

        // Draw lines
        keys.forEach(key => {
            const lineData = data.map(d => ({ year: d.year, value: d[key] / 1000 }));

            chart.append("path")
                .datum(lineData)
                .attr("fill", "none")
                .attr("stroke", color(key))
                .attr("stroke-width", 2)
                .attr("d", d3.line()
                    .x(d => x(d.year))
                    .y(d => y(d.value))
                );

            chart.selectAll(`circle.${key}`)
                .data(lineData)
                .enter()
                .append("circle")
                .attr("class", key)
                .attr("cx", d => x(d.year))
                .attr("cy", d => y(d.value))
                .attr("r", 5)
                .attr("fill", color(key))
                .on("mouseover", (event, d) => {
                    tooltip.style("display", "block")
                        .html(`<strong>${key}</strong><br>Jahr: ${d.year}<br>Anzahl: ${(d.value * 1000).toLocaleString()}`);
                })
                .on("mousemove", (event) => {
                    const tooltipWidth = tooltip.node().offsetWidth;
                    const mouseX = event.pageX;
                    const mouseY = event.pageY;

                    tooltip.style("left", `${mouseX + tooltipWidth > window.innerWidth ? mouseX - tooltipWidth - 10 : mouseX + 10}px`)
                        .style("top", `${mouseY - 20}px`);
                })
                .on("mouseout", () => {
                    tooltip.style("display", "none");
                });
        });

        // Legend
        const legend = chart.append("g")
            .attr("transform", `translate(10,100)`);

        keys.forEach((key, i) => {
            const legendRow = legend.append("g")
                .attr("transform", `translate(0,${i * 20})`);

            legendRow.append("rect")
                .attr("x", 0)
                .attr("y", 0)
                .attr("width", 18)
                .attr("height", 18)
                .attr("fill", color(key));

            legendRow.append("text")
                .attr("x", 24)
                .attr("y", 13)
                .style("font-size", "17px")
                .style("fill", "#fff")
                .text(key);
        });

        // Responsive adjustments
        const aspectRatio = (width + margin.left + margin.right) / (height + margin.top + margin.bottom);
        const updateDimensions = () => {
            const containerWidth = document.getElementById("inverkehrsetzungen").clientWidth;
            svg.attr("width", containerWidth)
                .attr("height", containerWidth / aspectRatio);
        };

        window.addEventListener("resize", updateDimensions);
        updateDimensions();
    }

    renderStackedBarChart() {
        const data = this.getConsolidatedData();

        const keys = ["Andere", "Alternative", "Konventionelle"];
        const colors = d3.scaleOrdinal().domain(keys).range(["#ffd700", "#2ca02c", "#d62728"]); // Gelb, Grün, Rot

        const margin = { top: 60, right: 150, bottom: 50, left: 70 };
        const width = 900 - margin.left - margin.right;
        const height = 600 - margin.top - margin.bottom;

        const svg = d3.select("#inverkehrsetzungen2")
            .append("svg")
            .attr("width", "100%")
            .attr("viewBox", `0 0 ${width + margin.left + margin.right} ${height + margin.top + margin.bottom}`)
            .attr("preserveAspectRatio", "xMinYMin meet");

        const chart = svg.append("g").attr("transform", `translate(${margin.left},${margin.top})`);

        const x = d3.scaleBand()
            .domain(data.map(d => d.year))
            .range([0, width])
            .padding(0.2);

        const y = d3.scaleLinear()
            .domain([0, 100])
            .range([height, 0]);

        const xAxis = d3.axisBottom(x).ticks(5).tickFormat(d3.format("d"));
        const yAxis = d3.axisLeft(y).ticks(5).tickFormat(d => `${d}%`);

        chart.append("g")
            .attr("transform", `translate(0,${height})`)
            .call(xAxis)
            .selectAll("text")
            .style("font-size", "15px");

        chart.append("g")
            .call(yAxis)
            .selectAll("text")
            .style("font-size", "15px");

        svg.append("text")
            .attr("x", (width + margin.left + margin.right) / 2)
            .attr("y", margin.top / 2)
            .attr("text-anchor", "middle")
            .style("font-size", "20px")
            .style("fill", "#fff")
            .text("Marktanteile nach Antriebsart (2005–2020)");

        chart.append("text")
            .attr("x", -height / 2)
            .attr("y", -margin.left + 20)
            .attr("transform", "rotate(-90)")
            .attr("text-anchor", "middle")
            .style("font-size", "15px")
            .style("fill", "#fff")
            .text("Anteil in %");

        const stackedData = d3.stack()
            .keys(keys)
            .value((d, key) => (d[key] / d.Total) * 100)(data);

        chart.selectAll(".bars")
            .data(stackedData)
            .enter()
            .append("g")
            .attr("fill", d => colors(d.key))
            .selectAll("rect")
            .data(d => d)
            .enter()
            .append("rect")
            .attr("x", d => x(d.data.year))
            .attr("y", d => y(d[1]))
            .attr("height", d => y(d[0]) - y(d[1]))
            .attr("width", x.bandwidth())
            .on("mouseover", (event, d) => {
                const year = d.data.year;
                const values = keys.map(key => `${key}: ${((d.data[key] / d.data.Total) * 100).toFixed(1)}%`).join("<br>");
                tooltip.style("visibility", "visible")
                    .html(`Jahr: ${year}<br>${values}`)
                    .style("top", `${event.pageY - 30}px`)
                    .style("left", `${event.pageX + 10}px`);
            })
            .on("mousemove", event => {
                tooltip.style("top", `${event.pageY - 30}px`)
                    .style("left", `${event.pageX + 10}px`);
            })
            .on("mouseout", () => tooltip.style("visibility", "hidden"));

        const legend = svg.append("g")
            .attr("transform", `translate(${width + margin.left + 10},${margin.top})`);

        keys.forEach((key, i) => {
            const legendRow = legend.append("g")
                .attr("transform", `translate(0,${i * 20})`);

            legendRow.append("rect")
                .attr("x", 0)
                .attr("y", 0)
                .attr("width", 18)
                .attr("height", 18)
                .attr("fill", colors(key));

            legendRow.append("text")
                .attr("x", 24)
                .attr("y", 13)
                .style("font-size", "15px")
                .style("fill", "#fff")
                .text(key);
        });

        const tooltip = d3.select("body").append("div")
            .attr("class", "tooltip")
            .style("position", "absolute")
            .style("background-color", "rgba(0, 0, 0, 0.8)")
            .style("color", "#fff")
            .style("padding", "5px")
            .style("border-radius", "4px")
            .style("visibility", "hidden")
            .style("font-size", "14px");
    }

}
