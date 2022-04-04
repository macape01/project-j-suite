import { useAuth } from "../hooks/authv2"

const Dashboard = () => {
    const { logout, user } = useAuth({ middleware: 'guest' })
    
    return (
        <>
            <p>{user?.name}</p>

            <button onClick={logout}>Sign out</button>
        </>
    )
}

export default Dashboard