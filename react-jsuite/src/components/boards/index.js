import { useState } from "react";
import Task from "./task";
import styles from "./styles.module.scss";

const Tasks = ({noteArray,completionArray,userArray,taskArray}) => {
  console.log(taskArray)
  return (
    <table className={`table table-bordered table-striped ${styles.tickets}`}>
      <tbody>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Completion</th>
          <th>Author</th>
        </tr>
      {
        taskArray.map(({id,author_id,completion_id,title})=>{
          let user = userArray.find(user=>user.id === author_id);
          let completion = completionArray.find(completion=>completion.id === completion_id);

          return (
            <Task
              id={id}
              title={title}
              completion={completion.name}
              author={user?.username}
            />
          );
        })
      }
      </tbody>
    </table>
  );
};
export default Tasks;