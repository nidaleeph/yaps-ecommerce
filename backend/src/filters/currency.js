// export default function currencyUSD(value) {
//   return new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'})
//     .format(value);
// }

export default function currencyPHP(value) {
  return new Intl.NumberFormat('en-PH', {style: 'currency', currency: 'PHP'})
    .format(value);
}
