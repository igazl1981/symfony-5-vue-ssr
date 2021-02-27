<template>
  <div class="hello">
    <h1>The Home Page</h1>
    <p>
      For a guide and recipes on how to configure / customize this project,<br>
      check out the
      <router-link :to="{name: 'numberSsr'}">To Number Ssr</router-link>
    </p>

  </div>
</template>

<script>
export default {
  name: 'HomePage',
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
