<template>
  <div class="hello">
    <h1>The Greeting Page</h1>
    <div>
      For a guide and recipes on how to configure / customize this project,<br>
      check out the
      <label> Name:
        <input v-model="name">
      </label>
      <button @click="getGreeting">Get the greeting</button>
      <div>
        <router-link :to="{name: 'home'}">To Home</router-link>
        <router-link :to="{name: 'numberSsr'}">To number ssr</router-link>
        <router-link :to="{name: 'layoutGreetings'}">To layout greetings</router-link>
      </div>
    </div>
    <div v-if="greeting">
      <h3>The Greeting:</h3>
      <div>{{ greeting }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GreetingsPage',
  data() {
    return {
      name: '',
      greeting: '',
      token: '',
    }
  },
  mounted() {
    fetch("/api/login_check", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: '{"username": "test_user", "password": "12345"}'
    })
        .then(response => {
          response.json()
              .then(value => this.token = value.token)
        })
  },
  methods: {
    getGreeting() {
      fetch('/api/secure/greetings?name=' + this.name,{
        headers: {
          'Authorization': 'Bearer ' + this.token
        }
      })
          .then(response => {
            console.log(response)
            response.json().then(value => this.greeting = value.greeting)
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
