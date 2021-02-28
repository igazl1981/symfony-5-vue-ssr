<template>
  <div class="hello">
    <h1>The Number Page</h1>
    <div>
      For a guide and recipes on how to configure / customize this project,<br>
      check out the
      <button @click="getNumber">Get the number</button>
      <div>
        <router-link :to="{name: 'home'}">To Home</router-link>
        <router-link :to="{name: 'layoutGreetings'}">To layout greetings</router-link>
        <router-link :to="{name: 'layoutGreetingsSecure'}">To layout greetings secure</router-link>
      </div>
    </div>
    <div v-if="number >= 0">
      <h3>The number</h3>
      <div>{{ number }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NumberPage',
  data() {
    return {
      number: -1
    }
  },
  methods: {
    getNumber() {
      fetch('/api/number')
          .then(response => {
            console.log(response)
            response.json().then(value => this.number = value.number)
          })
    }
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
