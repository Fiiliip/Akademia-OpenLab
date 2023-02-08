import { createStore } from 'vuex'

const store = createStore({
  state: {
    tasks: [
      {
        id: 1,
        title: "Kúpiť 2kg zemiakov.",
        isDone: false,
      },
      {
        id: 2,
        title: "Kúpiť 10ks vajec.",
        isDone: false,
      }
    ]
  }
})
export default store;
