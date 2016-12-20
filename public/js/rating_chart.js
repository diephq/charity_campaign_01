var Chart = function (options, star, one_star, two_star, three_star, four_star, five_star, rating) {
    this.options = options;
    this.star = star;
    this.one_star = one_star;
    this.two_star = two_star;
    this.three_star = three_star;
    this.four_star = four_star;
    this.five_star = five_star;
    this.rating = rating;
};

Chart.prototype = {
    init: function () {
        var _self = this;

        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(function() {
            _self.drawStuff();
        });
    },

    drawStuff: function () {
        var _self = this;
        var data = new google.visualization.arrayToDataTable([
            ['', ''],
            [_self.one_star + ' ' + _self.star, _self.options[_self.one_star] ? _self.options[_self.one_star] : 0],
            [_self.two_star + ' ' + _self.star, _self.options[_self.two_star] ? _self.options[_self.two_star] : 0],
            [_self.three_star + ' ' + _self.star, _self.options[_self.three_star] ? _self.options[_self.three_star] : 0],
            [_self.four_star + ' ' + _self.star, _self.options[_self.four_star] ? _self.options[_self.four_star] : 0],
            [_self.five_star + ' ' + _self.star, _self.options[_self.five_star] ? _self.options[_self.five_star] : 0],
        ]);
        var options = {
            title: _self.rating,
            legend: { position: 'none' },
            chart: { title: _self.rating },
            bars: 'horizontal',
            axes: {
                x: {
                    0: { side: 'top'}
                }
            },
            bar: { groupWidth: "90%" }
        };
        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
    }
};
