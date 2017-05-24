<?php

namespace DigiTickets\VerifoneWebService\Message\NonSessionBased;

use DigiTickets\VerifoneWebService\Message\AbstractRemoteRequest;
use DigiTickets\VerifoneWebService\Message\RejectResponse;

class RejectRequest extends AbstractRemoteRequest
{
    /**
     * @return string
     */
    public function getMsgType()
    {
        return 'RJT';
    }

    /**
     * @return string
     */
    public function getMsgData()
    {
        // Note: Some of the optional elements have been omitted. If added back in, make sure they're not populated for refunds.
        $tmp = '<?xml version="1.0"?>
<rejectionrequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="TXN">
<transactionid>'.$this->getTransactionId().'</transactionid>
<tokenid>'.$this->getTokenId().'</tokenid>
<capturemethod>12</capturemethod>
</rejectionrequest>';

        return $tmp; // @TODO: Put this back to returning the raw expression.
    }

    /**
     * @param RequestInterface $request
     * @param mixed $response
     * @return AbstractRemoteResponse
     */
    protected function buildResponse($request, $response)
    {
        return new RejectResponse($request, $response);
    }

    public function setTokenId($value)
    {
        return $this->setParameter('tokenid', $value);
    }

    public function getTokenId()
    {
        return $this->getParameter('tokenid');
    }
}