import { createStore } from 'vuex'
import axios from "axios";

const store = createStore({
  state: {
    tasks: [],
    inputText: "",
    useLocalStorage: localStorage.getItem("useLocalStorage_toDoList_#Filip") == "false" ? false : true
  },
  mutations: {
    addTask() {
      if (this.state.inputText == '') {
        alert("Nie je zadaný text pre novú úlohu.");
        return;
      }

      this.commit('checkSecretString');
      if (this.state.inputText[0] == '#') {
        this.state.inputText = '';
        return;
      };

      this.state.tasks.push({
        id: this.state.tasks.length == 0 ? 1 : this.state.tasks[this.state.tasks.length - 1].id + 1,
        title: this.state.inputText,
        completed: false
      });

      this.state.inputText = "";

      this.commit('saveData');
    },
    loadData() {
      console.log("Načítavam dáta...");

      if (this.state.useLocalStorage == true) { // Prečo tu musí byť "true" a nestačí len tá premenná?
        let data = JSON.parse(localStorage.getItem("toDoList_#Filip"));
        if (data != null) this.state.tasks = data.tasks;
        return;
      }

      // Lokálny server (localhost) je spusteny cez príkaz "php -S localhost:8081 tasks_GET.php" v priečinku, kde je daný súbor.
      let url = process.env.NODE_ENV !== 'production' ? 'http://localhost:8081/api/tasks_GET.php' : 'http://openlab.rf.gd/ToDoListVue/api/tasks_GET.php';

      axios.get(url)
        .then((response) => {
          this.state.tasks = response.data;
          console.log("Dáta boli načítané.")
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveData() {
      console.log("Ukladám dáta...");

      let data = {
        tasks: this.state.tasks
      }

      if (this.state.useLocalStorage == true) {
        localStorage.setItem("toDoList_#Filip", JSON.stringify(data));
        console.log("Dáta boli uložené do local storage.")
        return;
      }

      // Lokálny server (localhost) je spusteny cez príkaz "php -S localhost:8082 tasks_POST.php" v priečinku, kde je daný súbor.
      let url = process.env.NODE_ENV !== 'production' ? 'http://localhost:8082/api/tasks_POST.php' : 'http://openlab.rf.gd/ToDoListVue/api/tasks_POST.php';

      axios.post(url, data).then(response => {
        if (response.status == 200) {
          console.log("Dáta boli nahrané na server.");
        }
      }).catch(error => {
        console.log(error);
      });
    },
    checkSecretString() {
      if (this.state.inputText == "#localStorage") {
        this.state.useLocalStorage = true;
        alert("Zmenené nastavenia ukladania dát.\n\nDáta sa budú ukladať do lokálneho úložiska.");
      } else if (this.state.inputText == "#server") {
        this.state.useLocalStorage = false;
        alert("Zmenené nastavenia ukladania dát.\n\nDáta sa budú ukladať na server.");
      }

      localStorage.setItem("useLocalStorage_toDoList_#Filip", this.state.useLocalStorage);
      this.commit('saveData');
    }
  }
})
export default store;
