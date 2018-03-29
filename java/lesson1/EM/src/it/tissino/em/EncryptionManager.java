/**
 * A simple java package used to explain basic principles of OOP
 *
 * @author      Loris Tissino
 * @version     1.0
 */

package it.tissino.em;

/**
 * Represents an Encryption Manager, able to encrypt and decrypt messages.
 */
public class EncryptionManager {

    // ------------- attributes --------------

    /**
     * The cypher used.
     * 0 = Caesar, 1 = Vigenère
     */
    private int _cypher;

    /**
     * The shift used for Caesar Cypher.
     */
    private int _shift;

    // -------- getters and setters ----------

    /**
     * Changes the cypher used.
     * It is set to -1 if invalid
     * @param v the cypher
     */
    public void setCypher(int v)
    {
        if (v>=0 && v<=1) {
            _cypher = v;
        } else {
            _cypher = -1;
        }
    }

    /**
     * Gets the cypher used.
     * -1 means that the cypher is invalid.
     * @return the cypher used.
     */
    public int getCypher()
    {
        return _cypher;
    }

    /**
     * Changes the shift used.
     * @param v the shift
     */
    public void setShift(int v)
    {
        if (v<0) {
            _shift = 0;
        } else {
            _shift = v % 26;
        }
    }

    /**
     * Gets the shift used.
     * @return the shift used.
     */
    public int getShift()
    {
        return _shift;
    }

    // --------- public methods -----------

    /**
     * Decrypts a message with the current set cypher.
     * @param msg the message to decrypt
     * @return the message decrypted.
     */
    public  String decrypt(String msg) {
        if (_cypher==0){
            return _encrypt0(msg, 26 - _shift);
        }
        return "";
    }

    /**
     * Encrypts a message with the current set cypher.
     * @param msg the message to encrypt
     * @return the message encrypted.
     */
    public String encrypt(String msg) {
        if (_cypher==0){
            return _encrypt0(msg, _shift);
        }
        return "";
    }

    // --------- private methods -----------

    private String _encrypt0(String msg, int s)
    {
        String r = "";
        for (int i=0; i<msg.length(); i++) {
            int a = ((((int)msg.charAt(i) - 'A') + s ) % 26) + 'A';
            r = r + Character.toString((char)a);
        }
        return r;
    }

}
