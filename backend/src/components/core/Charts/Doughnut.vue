<script>
import { defineComponent, h } from 'vue'

import { Doughnut } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

export default defineComponent({
  name: 'DoughnutChart',
  components: {
    Doughnut
  },
  props: {
    chartId: {
      type: String,
      default: 'doughnut-chart'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Array,
      default: () => []
    },
    data: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      // Customize the tooltip
      plugins: {
        tooltip: {
          callbacks: {
            label: (context) => {
              // Access the price data from the dataset
              const price = props.data.datasets[0].price[context.dataIndex];
              return `${props.data.labels[context.dataIndex]}: ${context.formattedValue}, Total: ₱${price}`;
            }
          }
        }
      }
    }

    return () =>
      h(Doughnut, {
        chartData: props.data,
        chartOptions,
        chartId: props.chartId,
        width: props.width,
        height: props.height,
        cssClasses: props.cssClasses,
        styles: props.styles,
        plugins: props.plugins
      })
  }
})

</script>

<style scoped>

</style>
