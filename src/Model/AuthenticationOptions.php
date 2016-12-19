<?php

namespace Dnetix\MasterPass\Model;


/**
 * This class contains methods to set different authentication options required during DSRP.
 */
class AuthenticationOptions
{
    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    static $attributeMap = [
        'AuthenticateMethod' => 'AuthenticateMethod',
        'CardEnrollmentMethod' => 'CardEnrollmentMethod',
        'CAvv' => 'CAvv',
        'EciFlag' => 'EciFlag',
        'MasterCardAssignedID' => 'MasterCardAssignedID',
        'PaResStatus' => 'PaResStatus',
        'SCEnrollmentStatus' => 'SCEnrollmentStatus',
        'SignatureVerification' => 'SignatureVerification',
        'Xid' => 'Xid',
        'ExtensionPoint' => 'ExtensionPoint',
    ];

    static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    static $setters = [
        'authenticate_method' => 'setAuthenticateMethod',
        'card_enrollment_method' => 'setCardEnrollmentMethod',
        'c_avv' => 'setCAvv',
        'eci_flag' => 'setEciFlag',
        'master_card_assigned_id' => 'setMasterCardAssignedId',
        'pa_res_status' => 'setPaResStatus',
        'sc_enrollment_status' => 'setScEnrollmentStatus',
        'signature_verification' => 'setSignatureVerification',
        'xid' => 'setXid',
        'extension_point' => 'setExtensionPoint',
    ];

    static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    static $getters = [
        'authenticate_method' => 'getAuthenticateMethod',
        'card_enrollment_method' => 'getCardEnrollmentMethod',
        'c_avv' => 'getCAvv',
        'eci_flag' => 'getEciFlag',
        'master_card_assigned_id' => 'getMasterCardAssignedId',
        'pa_res_status' => 'getPaResStatus',
        'sc_enrollment_status' => 'getScEnrollmentStatus',
        'signature_verification' => 'getSignatureVerification',
        'xid' => 'getXid',
        'extension_point' => 'getExtensionPoint',
    ];

    static function getters()
    {
        return self::$getters;
    }


    /**
     * $authenticate_method the method used to authenticate the cardholder at checkout. Valid values are MERCHANT ONLY, 3DS and No Authentication.
     * @var string
     */
    public $AuthenticateMethod;

    /**
     * $card_enrollment_method the method by which the card was added to the wallet. Valid values are: Manual Direct Provisioned 3DS Manual NFC Tap.
     * @var string
     */
    public $CardEnrollmentMethod;

    /**
     * $c_avv the (CAVV) Cardholder Authentication Verification Value generated by card issuer upon successful authentication of the cardholder. This must be passed in the authorization message.
     * @var string
     */
    public $CAvv;

    /**
     * $eci_flag the Electronic commerce indicator (ECI) flag. Possible values are as follows: MasterCard: 00:No Authentication 01:Attempts (Card Issuer Liability) 02:Authenticated by ACS (Card Issuer Liability) 03:Maestro (MARP) 05:Risk Based Authentication (Issuer, not in use) 06:Risk Based Authentication (Merchant, not in use) Visa: 05:Authenticated (Card Issuer Liability) 06:Attempts (Card Issuer Liability) 07:No 3DS Authentication (Merchant Liability)
     * @var string
     */
    public $EciFlag;

    /**
     * $master_card_assigned_id the value assigned by MasterCard and represents programs associated directly with Maestro cards. This field should be supplied in the authorization request by the merchant.
     * @var string
     */
    public $MasterCardAssignedID;

    /**
     * $pa_res_status the message formatted, digitally signed, and sent from the ACS (issuer) to the MPI providing the results of the issuer's MasterCard SecureCode/Verified by Visa cardholder authentication. Possible values are: Y-The card was successfully authenticated via 3-D Secure A-signifies that either (a) the transaction was successfully authenticated via a 3-D Secure attempts transaction or (b)the cardholder was prompted to activate 3-D Secure during shopping but declined (Visa). U-Authentication results were unavailable.
     * @var string
     */
    public $PaResStatus;

    /**
     * $sc_enrollment_status the MasterCard SecureCode Enrollment Status. Indicates if the issuer of the card supports payer authentication for this card. Possible values are as follows: Y-The card is eligible for 3-D Secure authentication. N-The card is not eligible for 3-D Secure authentication. U-Lookup of the card's 3-D Secure eligibility status was either unavailable, or the card is inapplicable (for example, prepaid cards).
     * @var string
     */
    public $SCEnrollmentStatus;

    /**
     * $signature_verification the signature verification. Possible values are as follows: Y-Indicates that the signature of the PaRes has been validated successfully and the message contents can be trusted. N-Indicates that for a variety of reasons (tampering, certificate expiration, and so on) the PaRes could not be validated, and the result should not be trusted.
     * @var string
     */
    public $SignatureVerification;

    /**
     * $xid the transaction identifier resulting from authentication processing.
     * @var string
     */
    public $Xid;

    /**
     * $extension_point the ExtensionPoint for future enhancement.
     * @var ExtensionPoint
     */
    public $ExtensionPoint;


    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {

        if ($data != null) {
            $this->AuthenticateMethod = isset($data["AuthenticateMethod"]) ? $data["AuthenticateMethod"] : "";
            $this->CardEnrollmentMethod = isset($data["CardEnrollmentMethod"]) ? $data["CardEnrollmentMethod"] : "";
            $this->CAvv = isset($data["CAvv"]) ? $data["CAvv"] : "";
            $this->EciFlag = isset($data["EciFlag"]) ? $data["EciFlag"] : "";
            $this->MasterCardAssignedID = isset($data["MasterCardAssignedID"]) ? $data["MasterCardAssignedID"] : "";
            $this->PaResStatus = isset($data["PaResStatus"]) ? $data["PaResStatus"] : "";
            $this->SCEnrollmentStatus = isset($data["SCEnrollmentStatus"]) ? $data["SCEnrollmentStatus"] : "";
            $this->SignatureVerification = isset($data["SignatureVerification"]) ? $data["SignatureVerification"] : "";
            $this->Xid = isset($data["Xid"]) ? $data["Xid"] : "";
            $this->ExtensionPoint = isset($data["ExtensionPoint"]) ? $data["ExtensionPoint"] : "";
        }
    }

    /**
     * Gets authenticate_method
     * @return string
     */
    public function getAuthenticateMethod()
    {
        return $this->AuthenticateMethod;
    }

    /**
     * Sets authenticate_method
     * @param string $authenticate_method the method used to authenticate the cardholder at checkout. Valid values are MERCHANT ONLY, 3DS and No Authentication.
     * @return $this
     */
    public function setAuthenticateMethod($authenticate_method)
    {

        $this->AuthenticateMethod = $authenticate_method;
        return $this;
    }

    /**
     * Gets card_enrollment_method
     * @return string
     */
    public function getCardEnrollmentMethod()
    {
        return $this->CardEnrollmentMethod;
    }

    /**
     * Sets card_enrollment_method
     * @param string $card_enrollment_method the method by which the card was added to the wallet. Valid values are: Manual Direct Provisioned 3DS Manual NFC Tap.
     * @return $this
     */
    public function setCardEnrollmentMethod($card_enrollment_method)
    {

        $this->CardEnrollmentMethod = $card_enrollment_method;
        return $this;
    }

    /**
     * Gets c_avv
     * @return string
     */
    public function getCAvv()
    {
        return $this->CAvv;
    }

    /**
     * Sets c_avv
     * @param string $c_avv the (CAVV) Cardholder Authentication Verification Value generated by card issuer upon successful authentication of the cardholder. This must be passed in the authorization message.
     * @return $this
     */
    public function setCAvv($c_avv)
    {

        $this->CAvv = $c_avv;
        return $this;
    }

    /**
     * Gets eci_flag
     * @return string
     */
    public function getEciFlag()
    {
        return $this->EciFlag;
    }

    /**
     * Sets eci_flag
     * @param string $eci_flag the Electronic commerce indicator (ECI) flag. Possible values are as follows: MasterCard: 00:No Authentication 01:Attempts (Card Issuer Liability) 02:Authenticated by ACS (Card Issuer Liability) 03:Maestro (MARP) 05:Risk Based Authentication (Issuer, not in use) 06:Risk Based Authentication (Merchant, not in use) Visa: 05:Authenticated (Card Issuer Liability) 06:Attempts (Card Issuer Liability) 07:No 3DS Authentication (Merchant Liability)
     * @return $this
     */
    public function setEciFlag($eci_flag)
    {

        $this->EciFlag = $eci_flag;
        return $this;
    }

    /**
     * Gets master_card_assigned_id
     * @return string
     */
    public function getMasterCardAssignedId()
    {
        return $this->MasterCardAssignedID;
    }

    /**
     * Sets master_card_assigned_id
     * @param string $master_card_assigned_id the value assigned by MasterCard and represents programs associated directly with Maestro cards. This field should be supplied in the authorization request by the merchant.
     * @return $this
     */
    public function setMasterCardAssignedId($master_card_assigned_id)
    {

        $this->MasterCardAssignedID = $master_card_assigned_id;
        return $this;
    }

    /**
     * Gets pa_res_status
     * @return string
     */
    public function getPaResStatus()
    {
        return $this->PaResStatus;
    }

    /**
     * Sets pa_res_status
     * @param string $pa_res_status the message formatted, digitally signed, and sent from the ACS (issuer) to the MPI providing the results of the issuer's MasterCard SecureCode/Verified by Visa cardholder authentication. Possible values are: Y-The card was successfully authenticated via 3-D Secure A-signifies that either (a) the transaction was successfully authenticated via a 3-D Secure attempts transaction or (b)the cardholder was prompted to activate 3-D Secure during shopping but declined (Visa). U-Authentication results were unavailable.
     * @return $this
     */
    public function setPaResStatus($pa_res_status)
    {

        $this->PaResStatus = $pa_res_status;
        return $this;
    }

    /**
     * Gets sc_enrollment_status
     * @return string
     */
    public function getScEnrollmentStatus()
    {
        return $this->SCEnrollmentStatus;
    }

    /**
     * Sets sc_enrollment_status
     * @param string $sc_enrollment_status the MasterCard SecureCode Enrollment Status. Indicates if the issuer of the card supports payer authentication for this card. Possible values are as follows: Y-The card is eligible for 3-D Secure authentication. N-The card is not eligible for 3-D Secure authentication. U-Lookup of the card's 3-D Secure eligibility status was either unavailable, or the card is inapplicable (for example, prepaid cards).
     * @return $this
     */
    public function setScEnrollmentStatus($sc_enrollment_status)
    {

        $this->SCEnrollmentStatus = $sc_enrollment_status;
        return $this;
    }

    /**
     * Gets signature_verification
     * @return string
     */
    public function getSignatureVerification()
    {
        return $this->SignatureVerification;
    }

    /**
     * Sets signature_verification
     * @param string $signature_verification the signature verification. Possible values are as follows: Y-Indicates that the signature of the PaRes has been validated successfully and the message contents can be trusted. N-Indicates that for a variety of reasons (tampering, certificate expiration, and so on) the PaRes could not be validated, and the result should not be trusted.
     * @return $this
     */
    public function setSignatureVerification($signature_verification)
    {

        $this->SignatureVerification = $signature_verification;
        return $this;
    }

    /**
     * Gets xid
     * @return string
     */
    public function getXid()
    {
        return $this->Xid;
    }

    /**
     * Sets xid
     * @param string $xid the transaction identifier resulting from authentication processing.
     * @return $this
     */
    public function setXid($xid)
    {

        $this->Xid = $xid;
        return $this;
    }

    /**
     * Gets extension_point
     * @return ExtensionPoint
     */
    public function getExtensionPoint()
    {
        return $this->ExtensionPoint;
    }

    /**
     * Sets extension_point
     * @param ExtensionPoint $extension_point the ExtensionPoint for future enhancement.
     * @return $this
     */
    public function setExtensionPoint($extension_point)
    {

        $this->ExtensionPoint = $extension_point;
        return $this;
    }

}
