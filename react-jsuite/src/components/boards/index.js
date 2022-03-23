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
}) => {
  console.log("tasks", taskArray);
  return (
    <table className={`table table-bordered table-striped ${styles.tickets}`}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Completion</th>
          <th>Author</th>
          <th>Eliminacion</th>
          <th>Editacion</th>
        </tr>
        {taskArray.map((task) => {
          let user = userArray.find((user) => user.id === task.author_id);
          let completion = completionArray.find(
            (completion) => completion.id === task.completion_id
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
              author={user?.username}
            />
          );
        })}
      </tbody>
    </table>
  );
};
export default Tasks;
