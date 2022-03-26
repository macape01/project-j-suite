// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDlyCnJSq6nddMT9F7-9JK7geVpzRMm0ck",
  authDomain: "project-j-suite.firebaseapp.com",
  databaseURL: "https://project-j-suite-default-rtdb.europe-west1.firebasedatabase.app",
  projectId: "project-j-suite",
  storageBucket: "project-j-suite.appspot.com",
  messagingSenderId: "695074252391",
  appId: "1:695074252391:web:e27d90ceddeba6e99c56c2",
  measurementId: "G-WZGGF8RPYZ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

export const db = getFirestore(app);
