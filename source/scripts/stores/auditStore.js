import { observable, action, computed } from 'mobx';
import api from "../lib/api";

const METRICS = [
  {
    id: 1,
    name: "Прибиль",
    desc: "Прибуток отриманий компанією за поточний період"
  },
  {
    id: 2,
    name: "Кредит доверия",
    desc: "Количество средств доверенных компаниям группы БКВ банками-партнерами."
  },
  {
    id: 3,
    name: "Сотрудники",
    desc: "К-сть працівників з якими ми працювали бодай 1 день"
  },
  {
    id: 4,
    name: "Партнеры",
    desc: "К-сть партнерів з якими ми працювали бодай 1 день"
  },
  {
    id: 5,
    name: "Количество юр. лиц",
    desc: "К-сть партнерів з якими ми підписували бодай 1 папірець"
  }
];

class AuditStore {
  // @observable items = [
  //   {
  //     id: 1,
  //     title: "2015",
  //     metrics: [
  //       {
  //         id: 101,
  //         info: METRICS[0],
  //         value: 280.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 102,
  //         info: METRICS[1],
  //         value: 150.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 103,
  //         info: METRICS[2],
  //         value: 1150,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 104,
  //         info: METRICS[3],
  //         value: 5500,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 105,
  //         info: METRICS[4],
  //         value: 12,
  //         prefix: "",
  //         suffix: ""
  //       }
  //     ],
  //
  //   },
  //   {
  //     id: 2,
  //     title: "2016",
  //     metrics: [
  //       {
  //         id: 101,
  //         info: METRICS[0],
  //         value: 380.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 102,
  //         info: METRICS[1],
  //         value: 250.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 103,
  //         info: METRICS[2],
  //         value: 1250,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 104,
  //         info: METRICS[3],
  //         value: 6500,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 105,
  //         info: METRICS[4],
  //         value: 17,
  //         prefix: "",
  //         suffix: ""
  //       }
  //     ],
  //   },
  //   {
  //     id: 3,
  //     title: "2017",
  //     metrics: [
  //       {
  //         id: 101,
  //         info: METRICS[0],
  //         value: 480.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 102,
  //         info: METRICS[1],
  //         value: 350.6,
  //         prefix: "$",
  //         suffix: "MM"
  //       },
  //       {
  //         id: 103,
  //         info: METRICS[2],
  //         value: 2150,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 104,
  //         info: METRICS[3],
  //         value: 5500,
  //         prefix: "",
  //         suffix: ""
  //       },
  //       {
  //         id: 105,
  //         info: METRICS[4],
  //         value: 99,
  //         prefix: "",
  //         suffix: ""
  //       }
  //     ],
  //   }
  // ];
  //
  // @action getByStatsId(id) {
  //   return this.items.filter(item => item.id === id)[0];
  // }
  //
  // @computed get chartsData() {
  //   return METRICS.map(metric => {
  //
  //     const currentMetrics = this.items.map(item => {
  //       return item.metrics.filter(itemMetric => itemMetric.info.id === metric.id)[0];
  //     });
  //     return {
  //       id: metric.id,
  //       title: metric.name,
  //       items: currentMetrics.map((item, index) => {
  //
  //         const {value, prefix, suffix} = item;
  //           return {
  //             id: `${metric.id}_${index}`,
  //             title: this.items[index].title,
  //             value,
  //             prefix,
  //             suffix
  //           }
  //       })
  //     }
  //   })
  // }

  @observable data = null;

  @action fetch() {
    api("audit")
      .then(data => this.data = data);
  }
}

const auditStore = new AuditStore();

export default auditStore;
