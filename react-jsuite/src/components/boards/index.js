import { useState } from "react";
import Task from "./task";
import styles from "./styles.module.scss";

const Tasks = ({
  noteArray,
  completionArray,
  userArray,
  taskArray,
  esborrar,
  editar,
  uid
}) => {
  console.log("tasks", taskArray);
  return (
    <table className={`table table-bordered table-striped ${styles.tasks}`}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Completion</th>
          <th>Author</th>
          <th>Eliminacion</th>
          <th>Editacion</th>
        </tr>
        {taskArray
        .filter(t=>t.author_id === uid)
        .map((task) => {
          let user = userArray.find((user) => user.uid === task.author_id);
          let completion = completionArray.find((completion) => completion.id === task.completion_id
          );

          return (
            <Task
              key={task.id}
              editar={editar}
              esborrarTasca={esborrar}
              task={task}
              id={task.id}
              title={task.title}
              completion={completion.name}
              author={user?.name}
            />
          );
        })}
      </tbody>
    </table>
  );
};
export default Tasks;
