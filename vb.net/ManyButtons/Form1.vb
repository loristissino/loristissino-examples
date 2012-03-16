Public Class Form1

    Private Const BUTTONS_NUMBER As Integer = 10


    Private Sub cmdCreate_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cmdCreate.Click
        Dim i As Integer
        For i = 0 To BUTTONS_NUMBER - 1

            Dim AButton As New Button
            ' we create a new button...
            AButton.Left = 20
            AButton.Top = 50 + 40 * i
            ' we set the position...
            AButton.Text = "Button " & i
            ' we set the text...

            AButton.Tag = "MovingButton"

            AButton.BackColor = Color.Aqua

            AddHandler AButton.Click, AddressOf cmdGenericButton_Click
            ' we add the event handler for clicks (set to the address of a private sub defined below)...

            AddHandler AButton.MouseEnter, AddressOf cmdGenericButton_MouseEnter
            ' we add the event handler for MouseEnter events (set to the address of a private sub defined below)...

            AddHandler AButton.MouseLeave, AddressOf cmdGenericButton_MouseLeave
            ' we add the event handler for MouseLeave events (set to the address of a private sub defined below)...

            Me.Controls.Add(AButton)
            ' we add the new button to the form...

        Next

        cmdMove.Show()


    End Sub


    Private Sub cmdGenericButton_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        If Not sender.GetType() Is GetType(Button) Then
            Return
        End If
        ' we do nothing if we receive another kind of object as sender

        Dim ClickedButton As Button = sender

        ClickedButton.Left = ClickedButton.Left + 20
        ' we move the clicked button

    End Sub


    Private Sub cmdGenericButton_MouseEnter(ByVal sender As System.Object, ByVal e As System.EventArgs)
        If Not sender.GetType() Is GetType(Button) Then
            Return
        End If
        ' we do nothing if we receive another kind of object as sender

        Dim ClickedButton As Button = sender

        ClickedButton.BackColor = Color.Bisque
        ' we color the button when the mouse hovers on it

    End Sub


    Private Sub cmdGenericButton_MouseLeave(ByVal sender As System.Object, ByVal e As System.EventArgs)
        If Not sender.GetType() Is GetType(Button) Then
            Return
        End If
        ' we do nothing if we receive another kind of object as sender

        Dim ClickedButton As Button = sender

        ClickedButton.BackColor = Color.Aqua
        ' we set the color back to the default when the mouse leaves the button

    End Sub



    Private Sub cmdMove_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cmdMove.Click

        For Each AButton As Control In Me.Controls
            If AButton.Tag = "MovingButton" Then
                AButton.Left = AButton.Left + 20
            End If
        Next

    End Sub
End Class
