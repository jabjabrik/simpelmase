// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['Tidak / Belum Sekolah', 'Belum Tamat SD / Sederajat', 'Tamat SD / Sederajat', 'SLTP / Sederajat', 'SLTA / Sederajat', 'Dlipoma I / II', 'Akademi / Diploma III / S.Muda', 'Diploma IV / Strata I', 'Strata II', 'Strata III'],
    datasets: [{
      data: [12, 15, 11, 8, 12, 15, 11, 8, 12, 15],
      backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#33FFA1', '#A133FF', '#FF8C00', '#8CFF00', '#008CFF', '#FF008C']
    }],
  },
});
