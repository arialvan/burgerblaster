<table width="339" border="1" cellpadding="0">
  <tr>
    <td width="98">Pay taxes?</td>
    <td width="115">Make Discount?</td>
    <td width="118">Default unit price</td>
     <td>Quantity</td>
  </tr>
  <tr>
    <td>
      <select name="taxes" class="select">
        <option value="0" selected>no taxes</option>
        <option value="19">19% taxes</option>
      </select>
    </td>
    <td>
      <select name="discount" class="select">
        <option value="0" selected>no discount</option>
        <option value="5">5% discount</option>
        <option value="10">10% discount</option>
        <option value="20">20% discount</option>
      </select>
    </td>
    <td>
      <input type="text" name="cost" class="input140" value="1000">
    </td>
    <td><input type="text" name="quantity" value="1"></td>
  </tr>
  <tr>
    <td>Unit price after discount</td>
    <td>Tax per unit</td>
    <td>Total Price per unit</td>
     <td>Total Price to pay per quantity</td>
  </tr>
  <tr>
    <td><input type="text" name="price" value="1000"></td>
    <td><input type="text" name="ttaxes" value="0"></td>
    <td><input type="text" name="total" value="1000"></td>
    <td><input type="text" name="totaltopay" value="1000"></td>
  </tr>
 </table>

<script src="assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript"> 
var taxes    = document.getElementsByName('taxes')[0];
var discount = document.getElementsByName('discount')[0];
var cost     = document.getElementsByName('cost')[0];
var price    = document.getElementsByName('price')[0];
var ttaxes   = document.getElementsByName('ttaxes')[0];
var total    = document.getElementsByName('total')[0];
var quantity = document.getElementsByName('quantity')[0];

function updateInput() {
  price.value = cost.value - (cost.value * (discount.value / 100));
  ttaxes.value = (price.value * (taxes.value / 100));
  var sum = (parseFloat(price.value) + parseFloat(ttaxes.value)) * quantity.value;
  total.value = sum.toFixed(0);
}

taxes.addEventListener('change', updateInput);
discount.addEventListener('change', updateInput);
cost.addEventListener('change', updateInput);
cost.addEventListener('keyup', updateInput);
quantity.addEventListener('keyup', updateInput);
</script>