package it.tissino.em;

/**
 * Represents a Caesar Encryption Manager, able to encrypt and decrypt messages.
 */
public class CaesarEncryptionManager extends EncryptionManager {

    /**
     * The shift used for Caesar Cypher.
     */
    private int _shift;

    // -------- getters and setters ----------

    /**
     * Gets the cypher used.
     * @return the cypher used.
     */
    public String getCypher()
    {
        return "CAESAR";
    }

    /**
     * Changes the shift used.
     * @param v the shift
     * @return self
     */
    public CaesarEncryptionManager setShift(int v)
    {
        if (v<0) {
            _shift = 0;
        } else {
            _shift = v % 26;
        }
        return this;
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
        return _encrypt(msg, 26 - _shift);
    }

    /**
     * Encrypts a message with the current set cypher.
     * @param msg the message to encrypt
     * @return the message encrypted.
     */
    public String encrypt(String msg) {
        return _encrypt(msg, _shift);
    }

    // --------- private methods -----------

    private String _encrypt(String msg, int s)
    {
        String r = "";
        for (int i=0; i<msg.length(); i++) {
            int a = ((((int)msg.charAt(i) - 'A') + s ) % 26) + 'A';
            r = r + Character.toString((char)a);
        }
        return r;
    }

}
