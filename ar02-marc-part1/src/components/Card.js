import PropTypes from 'prop-types';
import Avatar from './Avatar';
import "./card.scss";
import Detail from './Detail';
import Name from './Name';
const Card = ({name,imgUrl,phone,email}) => {
    return <div className="card">
        <Name name={name}/>
        <Avatar avatar={imgUrl}/>
        <Detail detail={phone}/>
        <Detail detail={email}/>
    </div>
}
Card.propTypes={
    name: PropTypes.string.isRequired,
    imgUrl: PropTypes.string.isRequired,
    phone: PropTypes.string.isRequired,
    email: PropTypes.string.isRequired,
}

Card.defaultProps={
    name: "Sense definir",
    imgUrl: "Sense definir",
    phone: "Sense definir",
    email: "Sense definir",
}
export default Card;