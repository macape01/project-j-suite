import React from "react";

function ListProducts({ prods }) {
  return (
    <table style={{ border: "1px solid black" }}>
      <tbody>
        <tr>
          <th>Producte</th>
          <th>ID</th>
        </tr>
        {prods.map((prod, index) => {
          return (
            <tr key={`prod_${index}`}>
              <td>{prod.prodname}</td>
              <td>{index+1}</td>
            </tr>
          );
        })}
      </tbody>
    </table>
  );
}

export default ListProducts;
