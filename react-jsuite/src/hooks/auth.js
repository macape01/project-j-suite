
import axios from 'lib/axios'
import { useNavigate, useParams } from 'react-router-dom';

export const useAuth = (props) => {
    let navigate = useNavigate();

    const csrf = () => axios.get('/sanctum/csrf-cookie')

    const login = async ({ setErrors, setSuccessResponse }) => {
        await csrf()
        axios
            .post('/login', props)
            .then(() => {
                  setSuccessResponse();
                  navigate('/dashboard');
              })
              .catch(error => {
                setErrors(error);
            })
    }

    return {
        login
    }
}