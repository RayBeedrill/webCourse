<template>
  <div class="success-product">
    <h4>{{list.title}}</h4>
    <table class="table table-bordered table-condensed">
      <thead>
        <tr class="active">
          <td style="width:105px;">id</td>
          <td>title</td>
          <td>color</td>
          <td>size</td>
          <td>count</td>
          <td>price({{list.currency}})</td>
        </tr>
      </thead>    
      <tbody>
        <tr>
          <td>{{list.id}}</td>
          <td>{{list.title}}</td>
          <td>{{list.color}}</td>
          <td>{{list.size}}</td>
          <td>{{list.count}}</td>
          <td>{{list.price.toFixed(2)}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'SuccessBuy',
  data () {
    return {
      
      
    }
  },
  props:['list'],
}
</script>

