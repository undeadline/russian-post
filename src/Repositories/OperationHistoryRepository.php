<?php

namespace Undeadline\Repositories;

class OperationHistoryRepository
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function destination()
    {
        return $this->data->AddressParameters->DestinationAddress->Description;
    }

    public function destinationIndex()
    {
        return $this->data->AddressParameters->DestinationAddress->Index;
    }

    public function from()
    {
        return $this->data->AddressParameters->OperationAddress->Description;
    }

    public function fromIndex()
    {
        return $this->data->AddressParameters->OperationAddress->Index;
    }

    public function destinationId()
    {
        return $this->data->AddressParameters->MailDirect->Id;
    }

    public function destinationCode2A()
    {
        return $this->data->AddressParameters->MailDirect->Code2A;
    }

    public function destinationCode3A()
    {
        return $this->data->AddressParameters->MailDirect->Code3A;
    }

    public function destinationNameRu()
    {
        return $this->data->AddressParameters->MailDirect->NameRu;
    }

    public function destinationNameEn()
    {
        return $this->data->AddressParameters->MailDirect->NameEN;
    }

    public function fromCountryId()
    {
        return $this->data->AddressParameters->CountryFrom->Id;
    }

    public function fromCountryCode2A()
    {
        return $this->data->AddressParameters->CountryFrom->Code2A;
    }

    public function fromCountryCode3A()
    {
        return $this->data->AddressParameters->CountryFrom->Code3A;
    }

    public function fromCountryNameRu()
    {
        return $this->data->AddressParameters->CountryFrom->NameRu;
    }

    public function fromCountryNameEn()
    {
        return $this->data->AddressParameters->CountryFrom->NameEN;
    }

    public function operationCountryId()
    {
        return $this->data->AddressParameters->CountryOper->Id;
    }

    public function operationCountryCode2A()
    {
        return $this->data->AddressParameters->CountryOper->Code2A;
    }

    public function operationCountryCode3A()
    {
        return $this->data->AddressParameters->CountryOper->Code3A;
    }

    public function operationCountryNameRu()
    {
        return $this->data->AddressParameters->CountryOper->NameRu;
    }

    public function operationCountryNameEn()
    {
        return $this->data->AddressParameters->CountryOper->NameEN;
    }

    public function deliveryOnCash()
    {
        return $this->data->FinanceParameters->Payment;
    }

    public function declaredAmount()
    {
        return $this->data->FinanceParameters->Value;
    }

    public function commonAmount()
    {
        return $this->data->FinanceParameters->MassRate;
    }

    public function declaredAmountCommission()
    {
        return $this->data->FinanceParameters->InsrRate;
    }

    public function airAmount()
    {
        return $this->data->FinanceParameters->AirRate;
    }

    public function additionalCommision()
    {
        return $this->data->FinanceParameters->Rate;
    }

    public function customDuty()
    {
        return $this->data->FinanceParameters->CustomDuty;
    }

    public function barcode()
    {
        return $this->data->ItemParameters->Barcode;
    }

    public function internum()
    {
        return $this->data->ItemParameters->Internum;
    }

    public function validRu()
    {
        return $this->data->ItemParameters->ValidRuType;
    }

    public function validEn()
    {
        return $this->data->ItemParameters->ValidEnType;
    }

    public function name()
    {
        return $this->data->ItemParameters->ComplexItemName;
    }

    public function rankId()
    {
        return $this->data->ItemParameters->MailRank->Id;
    }

    public function rankName()
    {
        return $this->data->ItemParameters->MailRank->Name;
    }

    public function markId()
    {
        return $this->data->ItemParameters->PostMark->Id;
    }

    public function markName()
    {
        return $this->data->ItemParameters->PostMark->Name;
    }

    public function typeId()
    {
        return $this->data->ItemParameters->MailType->Id;
    }

    public function typeName()
    {
        return $this->data->ItemParameters->MailType->Name;
    }

    public function categoryId()
    {
        return $this->data->ItemParameters->MailCtg->Id;
    }

    public function categoryName()
    {
        return $this->data->ItemParameters->MailCtg->Name;
    }

    public function weight()
    {
        return $this->data->ItemParameters->Mass;
    }

    public function maxWeightRu()
    {
        return $this->data->ItemParameters->MaxMassRu;
    }

    public function maxWeightEn()
    {
        return $this->data->ItemParameters->MaxMassEn;
    }

    public function operationId()
    {
        return $this->data->OperationParameters->OperType->Id;
    }

    public function operationName()
    {
        return $this->data->OperationParameters->OperType->Name;
    }

    public function operationAttributeId()
    {
        return $this->data->OperationParameters->OperAttr->Id;
    }

    public function operationAttributeName()
    {
        return $this->data->OperationParameters->OperAttr->Name;
    }

    public function operationDate()
    {
        return $this->data->OperationParameters->OperDate;
    }

    public function senderCategoryId()
    {
        return $this->data->UserParameters->SendCtg->Id;
    }

    public function senderCategoryName()
    {
        return $this->data->UserParameters->SendCtg->Name;
    }

    public function sender()
    {
        return $this->data->UserParameters->Sndr;
    }

    public function recipient()
    {
        return $this->data->UserParameters->Rcpn;
    }

    public function __get($name)
    {
        if (method_exists($this, $name))
            return $this->{$name}();

        throw new \Exception("Property {$name} is not exists");
    }
}