import React from "react";

function ListProducts({ prods }) {
  return (
    <table style={{ border: "1px solid black" }}>
      <tbody>
        <tr>
          <th>Name</th>
          <th>Color</th>
        </tr>
        {prods.map((prod, index) => {
          return (
            <tr key={`prod_${index}`}>
              <td style={{ border: "1px solid black" }}>{prod.name}</td>
              <td style={{ border: "1px solid black" }}>{prod.color}</td>
            </tr>
          );
        })}
      </tbody>
    </table>
  );
}

export default ListProducts;
