import React from "react";

function LlistaProductes({ productes }) {
  return (
    <table style={{ border: "1px solid black" }}>
      <tbody>
        <tr>
          <th>Name</th>
          <th>Color</th>
        </tr>
        {productes.map((prod, index) => {
          return (
            <tr key={`prod_${index}`}>
              <td style={{ border: "1px solid black" }}>{prod.nom}</td>
              <td style={{ border: "1px solid black" }}>{prod.color}</td>
            </tr>
          );
        })}
      </tbody>
    </table>
  );
}

export default LlistaProductes;
